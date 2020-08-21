<?php

namespace Core;


use App\DiContainer;
use Core\Exceptions\NotFoundException;
use Core\Middleware\Middleware;
use Core\Middleware\StartMiddleware;

/**
 * Class App
 * @package Core
 */
class App extends Container
{
    /**
     * @var Request
     */
    protected $request;


    /**
     * Chain of middleware
     * @var Middleware
     */
    protected $middleware;

    /**
     * First we need to set instance of application using singleton pattern
     * which provide a global access point to application instance.
     * After that we bind all bindings which are located in register method
     * in DiContainer class.
     *
     * @param DiContainer $diContainer
     */
    public function __construct(DiContainer $diContainer)
    {
        $instance = static::setInstance($this);

        $diContainer->register($instance);
    }




    /**
     * Load method is responsible to find route according to url
     * and trigger defined method in defined controller class.
     *
     * @return App
     */
    public function load()
    {
        // Get instance of Router class which is responsible
        // to declare defined routes
        $router = new Router();


        // Here is file which contains all defined routes
        // Defined routes look like:
        //      * $router->get('/foo', 'FooController@foo')
        require_once '../routes/route.php';


        try {
            // Find route which user shoot and try to parse controller,
            // method and route params.
            $this->request = $router->parseRoute(new Request());


            // Make chain of middleware defined in Core.php class
            $this->middleware = (new StartMiddleware())->loadMiddleware();

        } catch (NotFoundException $e) {
            //TODO make 404 page
            dd("Not Found 404" . $e->getMessage());
        } catch (\Exception $e) {
            dd("Middleware exception: " . $e->getMessage());
        }


        return $this;
    }


    /**
     * Handle throught all middleware
     */
    public function handle()
    {
        return $this->middleware->handle($this->request);
    }

}