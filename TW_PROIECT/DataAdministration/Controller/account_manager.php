<?php
include("./../Model/users_model.php");

class AccountManager
{
    public static function login(){
        if (!isset($_POST["username"])){
            return self::error_handle("Username is required!");
        }
        if (!isset($_POST["password"])){
            return self::error_handle("Password is required!");
        }

        // to do: check username
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user_model = new UsersModel();
        $hashed_password = $user_model->get_password_for($username);

        if (password_verify($password, $hashed_password)){
            $user_id = $user_model->get_user_id($username);
            $data["user_id"] = $user_id;
            $data["live_time"] = SESSION_TIME;
            $token = JWT::encode($data);
            $answer["success"] = true;
            $answer["token"] = $token;
            return json_encode($answer);
        }

        return self::error_handle("Username or password is incorrect.");
    }

    public static function register(){
        if (!isset($_POST["username"])){
            return self::error_handle("Username is required!");
        }
        if (!isset($_POST["password"])){
            return self::error_handle("Password is required!");
        }
        if (!isset($_POST["register_token"])){
            return self::error_handle("Register_token is required!");
        }

        $user_model = new UsersModel();
        $username = $_POST["username"];
        $password = $_POST["password"];
        $register_token = $_POST["register_token"];

        $password = password_hash($password, PASSWORD_BCRYPT);

        $user_id = $user_model->get_user_id($username);
        if ($user_id !== null){
            return self::error_handle("Username already exists.");
        }

        if ($register_token !== register_token){
            return self::error_handle("Register token wrong.");
        }

        $res = $user_model->create_user($username, $password);
        if ($res == false){
            return self::error_handle("Unknown error.");
        }

        $data["user_id"] = $user_id;
        $token = JWT::encode($data);
        $answer["success"] = true;
        $answer["token"] = $token;
        http_response_code(201);
        return json_encode($answer);
    }

    public static function create_event(){
        $token = JWT::get_token_from_header();
        $validate_answer = JWT::validate($token);
        if ($validate_answer != "OK") {
            return $validate_answer;
        }

        $user_id = JWT::decode($token)["user_id"];

        $validate_data_answer = self::create_event_validate_data();

        if ($validate_data_answer != "OK"){
            return $validate_data_answer;
        }

        $query_data = self::extract_event_data();

        return $user_id;
    }

    private static function extract_event_data(){

    }

    private static function create_event_validate_data(){

    }

    public static function error_handle($message){
        http_response_code(400);

        $answer["success"] = "err";
        $answer["error_message"] = $message;

        return json_encode($answer);
    }
}