<?php

class Router{
    private $supported_methods = array(
            "GET",
            "POST"
        );
    private $get_functions = array();
    private $post_functions = array();

    public function add_route($method, $path, $function){
        $method = strtoupper($method);

        switch ($method){
            case "GET":
                $this->insert_route($path, $this->get_functions, $function);
                break;
            case "POST":
                $this->insert_route($path, $this->post_functions, $function);
                break;
        }
    }

    private function check_name($name){
        $legal_characters = "/[a-zA-Z0-9_]+/";
        if ($name == '/')
            return true;
        if (empty($name))
            return false;
        if (!preg_match($legal_characters, $name))
            return false;
        return true;
    }

    public function route($request){
        $method = $request->get_method();

        if (!in_array($method, $this->supported_methods)){
            $this->handle_unsupported_method();
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

    /**
     * For a request with method = get find the callback function for a certain path.
     * If the path contains parameters, the list of parameters is passed as parameter to
     * the function.
     * @param $request
     * @return mixed
     */
    private function get($request){
        $path = $request->get_path();
        $function = $this->find_function($path, $this->get_functions, $parameters);
        if (is_null($function)){
            $this->handle_not_found();
            die();
        }

        if (empty($parameters))
            return call_user_func($function);
        return call_user_func($function, $parameters);
    }

    private function post($request){
        $path = $request->get_path();
        $function = $this->find_function($path, $this->post_functions, $parameters);
        if (is_null($function)){
            $this->handle_not_found();
            die();
        }

        if (empty($parameters))
            return call_user_func($function);
        return call_user_func($function, $parameters);
    }


    /**
     * Insert a path like example/of/path in dictionary dict in the following form:
     * dict['example'] = dictB
     * dictB['of'] = dictC
     * dictC['path'] = dictD
     * dictD['#'] = function
     * End points are marked with '#'. Also if a name is empty (example//path) it is
     * saved in dict as '/'.
     * @param $path
     * @param $dict
     * @param $function
     */
    private function insert_route($path, &$dict, $function){
        $path = trim($path, '/');
        $path = explode('/', $path);
        foreach ($path as $name){
            if (empty($name)){
                $this->handle_forbidden_path_name();
                die();
            }
            else if ($name[0] == '{' && $name[strlen($name) - 1] == '}'){
                if (!$this->check_name(substr($name, 1, strlen($name) - 2))){
                    $this->handle_forbidden_path_name();
                    die();
                }
                if (!isset($dict['{}'])){
                    $dict['{}'] = [];
                }
                $dict = &$dict['{}'];
            }
            else {
                if (!$this->check_name($name)) {
                    $this->handle_forbidden_path_name();
                    die();
                }
                if (!isset($dict[$name])){
                    $dict[$name] = [];
                }
                $dict = &$dict[$name];
            }
        }
        if (isset($dict['#'])){
            $this->handle_redeclaration_of_path();
            die();
        }
        $dict['#'] = $function;
    }


    /**
     * Check if a path like example/of/path is present in dictionary dict and
     * if it is return the callback function saved there.
     * $parameters is used to return the list of parameters from link.
     * See insert_route
     * @param $path
     * @param $dict
     * @param $parameters
     * @return mixed
     */
    private function find_function($path, $dict, &$parameters){
        $path = trim($path, '/');
        $path = explode('/', $path);
        $parameters = [];
        foreach ($path as $name){
            if (empty($name))
                $name = '/';
            if (!$this->check_name($name)) {
                $this->handle_forbidden_path_name();
                die();
            }
            if (isset($dict[$name])){
                $dict = &$dict[$name];
            }
            else if (isset($dict['{}'])){
                $dict = &$dict['{}'];
                array_push($parameters, $name);
            }
            else{
                $this->handle_not_found();
                die();
            }
        }
        if (!isset($dict['#'])){
            $this->handle_not_found();
            die();
        }
        return $dict['#'];
    }

    private function handle_forbidden_path_name(){
        echo "Forbidden path name!";
    }

    private function handle_unsupported_method(){
        http_response_code(405);
    }

    private function handle_not_found(){
        http_response_code(404);
    }

    private function handle_redeclaration_of_path()
    {
        echo "Path redeclaration!";
    }
}