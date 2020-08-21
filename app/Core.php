<?php

namespace App;

use App\Middleware\ExampleMiddleware;
use Core\Middleware\StartMiddleware;

class Core
{
    /**
     * User defined middlewares
     * @var string[]
     */
    public static $middleware = [
        ExampleMiddleware::class,
    ];
}