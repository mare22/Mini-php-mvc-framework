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
}