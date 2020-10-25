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
     * Chain all user defined middlewares using "Chain of responsibility pattern".
     *
     * On the end of chain set InvokeMethodMiddleware which will call method
     * in controller.
     *
     * @return Middleware $this
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

    /**
     * All middlewares must implement this method.
     *
     * @param Request $request
     * @return mixed
     */
    public abstract function handle(Request $request);
}