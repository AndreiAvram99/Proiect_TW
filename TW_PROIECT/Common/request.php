<?php

class Request{
    function get_method(){
        return strtoupper($_SERVER["REQUEST_METHOD"]);
    }

    function get_args(){
        return $_REQUEST;
    }

    function get_path()
    {
        $request_uri = $_SERVER['REQUEST_URI'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        $path = substr($request_uri, strlen($script_name));
        if (empty($path))
            return '/';

        $pos = strpos($path, '?');
        if ($pos !== false)
            $path = substr($path, 0, $pos);

        return $path;
    }
}