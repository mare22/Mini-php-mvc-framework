<?php

/*
 * This file is responsible for loading and send response
 */


require_once '../vendor/autoload.php';


/**
 * This file contains global helper functions
 */
require_once '../helpers.php';




/**
 * Instance application and bind important class
 */
$app = require_once '../bootstrap.php';



/**
 * Load method declares all defined routes in route.php file,
 * try to instance define controller for specific route,
 * if define method contains some params, it will declare
 * into array.
 *
 * @return Closure function
 */
$response = $app->load()->handle();


/**
 * Function will send response
 */
//$response();