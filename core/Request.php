<?php

namespace Core;

class Request
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var mixed
     */
    public $requestMethod;

    /**
     * Contain controller
     * @var string
     */
    public $controller;


    /**
     * Contain method which will invoked
     * @var string
     */
    public $method;


    /**
     * Contain array of params from url
     * which user defined in route file
     * @var array
     */
    public $params;


    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->url = $this->getUrl();

        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        $uri = rtrim($_SERVER['REQUEST_URI'], '/');
        $uri = filter_var($uri, FILTER_SANITIZE_URL);

        return $uri;
    }
}