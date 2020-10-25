<?php

/*
 * This is place where you can defined your rotes.
 * You can defined get, post, put, patch or delete routes.
 * First param is route and second param is Controller and method
 * which are concat with "@".
 *
 * You can also set parameters in route like:
 * $route->get('/user/{id}', 'UserController@index')
 *
 * This "id" would be injected into method parameter.
 */

$router->get('/', 'WelcomeController@index');


$router->get('/login', 'Auth\LoginController@login');


$router->get('/user/{user}/product/{id}', 'WelcomeController@index');


$router->get('/home', 'HomeController@index');

$router->get('/example', 'HomeController@example');
