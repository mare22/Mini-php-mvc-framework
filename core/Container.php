<?php

namespace Core;

class Container
{
    /**
     * @var array
     */
    protected $bindings = [];

    /**
     * @var array
     */
    protected $singletons = [];


    /**
     * @var App
     */
    protected static $instance;

    /**
     * If value is Closure function them set return value of that function in
     * singleton array (hash map).
     * If value is Class set instance of that class in singleton array.
     *
     * When method getSingleton is called always will be return same instance of
     * class by key.
     *
     * @param mixed $key
     * @param null|mixed $value
     * @return mixed|object
     * @throws \ReflectionException
     */
    public function singleton($key, $value = null)
    {
        if(array_key_exists($key, $this->singletons)) {
            return $this->singletons[$key];
        }

        if($value instanceof \Closure) {
            $this->singletons[$key] = $value();

            return $this->singletons[$key];
        }

        if(is_null($value)) {
            $value = $key;
        }

        $this->singletons[$key] = (new \ReflectionClass($value))->newInstance();

        return $this->singletons[$key];
    }

    /**
     * Return singleton by key.
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function getSingleton($key)
    {
        if(! array_key_exists($key, $this->singletons)) {
            return null;
        }

        return $this->singletons[$key];
    }



    /**
     * @param mixed $key
     * @param null|mixed $value
     * @throws \Exception
     */
    public function bind($key, $value = null)
    {
        // If key already exist them throw exception
        if(array_key_exists($key, $this->bindings)) {
            throw new \Exception("{$key} is already exist");
        }

        if(is_null($value)) {
            $value = $key;
        }

        $this->bindings[$key] = $value;
    }


    /**
     * Return binding by key.
     *
     * @param mixed $key
     * @return mixed|null
     */
    public function make($key)
    {
        // Check if binding exist by given key.
        if(! array_key_exists($key, $this->bindings)) {
            return null;
        }

        // If binding is Closure function, them return value of that function
        if($this->bindings[$key] instanceof \Closure) {
            return $this->bindings[$key]->call();
        }

        // Return instance of class.
        return new $this->bindings[$key];
    }


    /**
     * Return instance of application
     *
     * @return App
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set instance of our application.
     *
     * @param App $app
     * @return App
     */
    public static function setInstance(App $app)
    {
        return static::$instance = $app;
    }
}