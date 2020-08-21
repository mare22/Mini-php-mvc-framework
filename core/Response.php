<?php


namespace Core;


class Response
{
    /**
     * @param $view
     * @param array $data
     * @return \Closure
     */
    public function view($view, $data = [])
    {
        return function() use ($view, $data) {

            $view = str_replace('.', '/', $view);

            $viewPath = root_path() . "/resources/views/$view.view.php";

            if(!file_exists($viewPath)) {
                throw new Exception("File {$view} does not exist");
            }

            require_once $viewPath;
        };
    }

    public function json($data)
    {
        header('Accept: application/json');
        header('Content-type: application/json');

        echo json_encode($data);
    }
}