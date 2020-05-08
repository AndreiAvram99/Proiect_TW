<?php

class Router{
    private $supported_methods = array(
            "GET",
            "POST"
        );
    private $get_functions = array();
    private $post_functions = array();

    function add_route($method, $path, $function){
        $method = strtoupper($method);

        switch ($method){
            case "GET":
                $this->get_functions[$path] = $function;
                break;
            case "POST":
                $this->post_functions[$path] = $function;
        }
    }

    function route($request){
        $method = $request->get_method();

        if (!in_array($method, $this->supported_methods)){
            http_response_code(405);
            die();
        }

        switch ($method){
            case "GET":
                return $this->get($request);
                break;
            case "POST":
                return $this->post($request);
        }
    }

    function get($request){
        $path = $request->get_path();
        if (!isset($this->get_functions[$path])){
            http_response_code(404);
            die();
        }
        $function = $this->get_functions[$path];

        return call_user_func($function);
    }

    function post($request){
        $path = $request->get_path();
        if (!isset($this->post_functions[$path])){
            http_response_code(404);
            die();
        }
        $function = $this->post_functions[$path];

        call_user_func($function, $request);

    }
}