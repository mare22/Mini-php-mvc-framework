<?php

namespace App;

use App\Services\ExampleService;
use App\Services\ExampleServiceInterface;
use Core\Container;

class DiContainer
{
    /**
     * Here you can bind your Classes, Closures, Variables .. what ever
     *
     * @param Container $container
     * @throws \Exception
     */
    public function register(Container $container)
    {
        $container->bind(ExampleServiceInterface::class, ExampleService::class);
    }
}