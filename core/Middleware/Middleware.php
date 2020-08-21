<?php

namespace Core\Middleware;

use App\Core;
use Core\Request;

abstract class Middleware
{
    protected $next;

    /**
     * @param Middleware $next
     */
    public function setNext(Middleware $next)
    {
        if($this->next == null) {
            $this->next = $next;
        } else {
            $this->next->setNext($next);
        }
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function next(Request $request)
    {
        if(!$this->next) {
            return true;
        }

        return $this->next->handle($request);
    }

    /**
     * All middlewares must implement this method.
     *
     * @param Request $request
     * @return mixed
     */
    public abstract function handle(Request $request);
}