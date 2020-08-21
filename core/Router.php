<?php

namespace Core;


use Core\Exceptions\NotFoundException;

class Router
{
    /**
     *
     * Application make regex pattern from defined route, because developer can
     * defined route with params like:
     *
     * /user/{id}/product/{id}
     *
     * And application transform that route to pattern like this:
     *
     * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
     *
     * That is necessary because application match url with defined routes.
     *
     *
     * Here is example of format $routes array where application store
     * defined routes in route.php file.
     * [
     *      GET => [
     *          '/^\/$/' => 'Controller@index'
     *      ],
     *      DELETE => [
     *          '/uri/delete' => 'Controller@delete',
     *      ],
     * ]
     */
    protected $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'PATCH' => [],
        'DELETE' => []
    ];


    public const ROUTE_PATTERN = ['/(\/)/', '/({[a-zA-Z0-9]+})/'];

    public const ROUTE_REPLACEMENT = ['\/', '([^\/]+)'];


    /**
     * Application goes through all defined routes by request method
     * and try to match request route and defined route in route.php file.
     *
     * If route match then will be return array with defined controller and
     * class method, otherwise throw Exception.
     *
     * @param Request $request
     * @return Request
     * @throws \Exception
     */
    public function parseRoute(Request $request)
    {
        if(!$request->url) {
            $request->url = '/';
        }

        // Loop through all defined routes by request method.
        foreach ($this->routes[$request->requestMethod] as $routePattern => $controller) {

            if(preg_match_all($routePattern, $request->url, $params)) {

                array_shift($params);

                list($request->controller, $request->method) = explode('@', $controller);

                $request->params = $params;

                return $request;
            }
        }

        throw new NotFoundException('No route defined.');
    }


    /**
     * Here is methods where we transform defined route to route pattern
     *
     * @param $route
     * @param $controller
     */
    public function get($route, $controller)
    {
        // * Replace $route like this:
        // * /user/{id}/product/{id}
        // * to this:
        // * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
        $routePattern = $this->replaceRoute($route);


        // * Add $routePatter to array in this format
        // * [
        // *    GET => [ '/^\/user\/([^\/]+)\/product\/([^\/]+)$/' => 'Controller@index'],
        // * ]
        $this->routes['GET'][$routePattern] = $controller;
    }

    /**
     * Here is methods where we transform defined route to route pattern
     *
     * @param $route
     * @param $controller
     */
    public function post($route, $controller)
    {
        // * Replace $route like this:
        // * /user/{id}/product/{id}
        // * to this:
        // * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
        $routePattern = $this->replaceRoute($route);


        // * Add $routePatter to array in this format
        // * [
        // *    POST => [ '/^\/user\/([^\/]+)\/product\/([^\/]+)$/' => 'Controller@index'],
        // * ]
        $this->routes['POST'][$routePattern] = $controller;
    }


    /**
     * Here is methods where we transform defined route to route pattern
     *
     * @param $route
     * @param $controller
     */
    public function put($route, $controller)
    {
        // * Replace $route like this:
        // * /user/{id}/product/{id}
        // * to this:
        // * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
        $routePattern = $this->replaceRoute($route);


        // * Add $routePatter to array in this format
        // * [
        // *    PUT => [ '/^\/user\/([^\/]+)\/product\/([^\/]+)$/' => 'Controller@index'],
        // * ]
        $this->routes['PUT'][$routePattern] = $controller;
    }

    /**
     * Here is methods where we transform defined route to route pattern
     *
     * @param $route
     * @param $controller
     */
    public function patch($route, $controller)
    {
        // * Replace $route like this:
        // * /user/{id}/product/{id}
        // * to this:
        // * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
        $routePattern = $this->replaceRoute($route);


        // * Add $routePatter to array in this format
        // * [
        // *    PATCH => [ '/^\/user\/([^\/]+)\/product\/([^\/]+)$/' => 'Controller@index'],
        // * ]
        $this->routes['PATCH'][$routePattern] = $controller;
    }

    /**
     * Here is methods where we transform defined route to route pattern
     *
     * @param $route
     * @param $controller
     */
    public function delete($route, $controller)
    {
        // * Replace $route like this:
        // * /user/{id}/product/{id}
        // * to this:
        // * /^\/user\/([^\/]+)\/product\/([^\/]+)$/
        $routePattern = $this->replaceRoute($route);


        // * Add $routePatter to array in this format
        // * [
        // *    DELETE => [ '/^\/user\/([^\/]+)\/product\/([^\/]+)$/' => 'Controller@index'],
        // * ]
        $this->routes['DELETE'][$routePattern] = $controller;
    }


    /**
     *
     * Replace $route like this:
     *      /user/{id}/product/{id}
     * to this:
     *      /^\/user\/([^\/]+)\/product\/([^\/]+)$/
     *
     * @param $route
     * @return string
     */
    private function replaceRoute($route)
    {
        $replaced = preg_replace(self::ROUTE_PATTERN, self::ROUTE_REPLACEMENT, $route);

        return "/^$replaced$/";
    }
}