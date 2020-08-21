<?php


use Core\Container;
use Core\Response;

/**
 * Drop and die.
 * @param mixed ...$vars
 */
function dd(...$vars) {
    foreach ($vars as $var) {
        var_dump($var);
    }
    die();
}

/**
 * Return instance of application
 *
 * @return \Core\App
 */
function app() {
    return Container::getInstance();
}

/**
 * @param $view
 * @param array $data
 * @return Closure
 */
function view($view, $data = []) {

    return (new Response())
                    ->view($view,$data);
}

/**
 * @return string
 */
function root_path() {
    return __DIR__;
}


/**
 * @param string $value
 * @return string|string[]
 */
function toBackslash(string $value) {

    $value =  str_replace("/", "\\\\", $value);

    return $value;
}