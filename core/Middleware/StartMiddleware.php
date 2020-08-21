<?php

namespace Core\Middleware;

use App\Core;
use Core\Request;

class StartMiddleware extends Middleware
{
    /**
     * This is first middleware which only call
     * next middleware.
     *
     * @param Request $request
     * @return bool
     */
    public function handle(Request $request)
    {
        return parent::next($request);
    }


    /**
     * Chain all user defined middlewares using "Chain of responsibility pattern".
     *
     * On the end of chain set InvokeMethodMiddleware which will call method
     * in controller.
     *
     * @return StartMiddleware $this
     * @throws \Exception
     */
    public function loadMiddleware()
    {
        try {

            // User defined middleware
            foreach (Core::$middleware as $middleware) {
                $this->setNext(new $middleware());
            }

            // Core middleware
            $this->setNext(new InvokeMethodMiddleware());


            return $this;

        } catch (\Exception $e) {

            throw $e;
        }

    }
}