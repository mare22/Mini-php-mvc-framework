<?php


use App\DiContainer;
use Core\App;
use Core\Database\Connection;



// Get instance of app and register all bindings,
// which are located in DiContainer class.
$app = new App(new DiContainer());


// Get database configuration.
$config = require 'config/config.php';


// Make mysql connection and set pdo object in singleton hash map.
$app->singleton('connection', function () use ($config) {
    return Connection::make(
        $config['database']
    );
});



return $app;