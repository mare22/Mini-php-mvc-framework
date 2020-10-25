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
        extract($data);

        $viewContent = (new ViewRender($view))->render();

        //TODO we should cache rendered files
        $cachedFilePath = root_path() . "/core/Cache/view/random.view.php";
        $file = fopen($cachedFilePath, "w");
        fwrite($file, $viewContent);
        fclose($file);

        require($cachedFilePath);
    }

    public function json($data)
    {
        header('Accept: application/json');
        header('Content-type: application/json');

        echo json_encode($data);
    }
}