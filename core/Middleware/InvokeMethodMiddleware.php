<?php

namespace Core\Middleware;

use Core\Request;

class InvokeMethodMiddleware extends Middleware
{
    /**
     * First check if method and constructor have
     * any parameters and then call method using reflection.
     *
     * We check that because of dependency injection.
     * User can set arguments as model, interface or whatever type are defined in DIContainer class.
     *
     * @param Request $request
     * @throws \ReflectionException
     */
    public function handle(Request $request)
    {
        $reflectionClass = new \ReflectionClass(
            'App\\Controllers\\' . str_replace("/", "\\\\", $request->controller)
        );

        $method = $reflectionClass->getMethod($request->method);
        $methodParams = $this->getMethodParams($method, $request);

        $constructor = $reflectionClass->getConstructor();
        $constructorParams = [];
        if($constructor) {
            $constructorParams = $this->getMethodParams($constructor, $request);
        }

        return $method->invokeArgs(
            $reflectionClass->newInstanceArgs($constructorParams),
            $methodParams
        );
    }


    /**
     * This method should make array with arguments for given reflection method.
     *
     * 1. Get typeof property
     * 2. Check if that property Class or Interface
     *      2.1 Check if parent of that class is QueryBuilder
     *          2.1.1 Push to array instance of that class
     *      2.2 Check if that class is located in Dependency injection Container
     *          2.2.1 Push to array instance from Dependency injection Container
     * 3. Move first index of request params to array
     * 4. Loop for each param in method
     *
     * @param \ReflectionMethod $reflectionMethod
     * @param Request $request
     * @return array
     */
    private function getMethodParams(\ReflectionMethod $reflectionMethod, Request $request)
    {
        $methodParams = [];

        foreach ($reflectionMethod->getParameters() as $param) {

            $typeProperty = (string)$param->getType();

            if(class_exists($typeProperty) || interface_exists($typeProperty)) {

                if(get_parent_class($typeProperty) == 'Core\\Database\\Model') {
                    array_push($methodParams, new $typeProperty());
                    continue;
                }

                $bindValue = app()->make($typeProperty);

                if(isset($bindValue)) {
                    array_push($methodParams, $bindValue);
                }

                continue;
            }


            array_push($methodParams, array_shift($request->params)[0]);
        }

        return $methodParams;
    }
}