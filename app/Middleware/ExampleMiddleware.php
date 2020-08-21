<?php

namespace App\Middleware;

use Core\Middleware\Middleware;
use Core\Request;

class ExampleMiddleware extends Middleware
{
    public function handle(Request $request)
    {
        // Here you can implement logic...

        return parent::next($request);
    }
}