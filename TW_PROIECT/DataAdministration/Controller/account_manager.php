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
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user_model = new UsersModel();
    }


    public static function register(){

    }

    public static function error_handle($message){
        http_response_code(400);

        $answer["success"] = "err";
        $answer["error_message"] = $message;

        return json_encode($answer);
    }
}