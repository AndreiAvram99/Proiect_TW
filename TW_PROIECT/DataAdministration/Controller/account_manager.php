<?php
include("./../Model/users_model.php");
include("./../Model/event_model.php");

class AccountManager
{
    public static function login(){
        header('Content-Type: application/json');

        if (!isset($_POST["username"])){
            return self::error_handle("Username is required!");
        }
        if (!isset($_POST["password"])){
            return self::error_handle("Password is required!");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        if (self::check_username($username) !== 'OK' ||
            self::check_password($password) !== 'OK'){
            return self::error_handle("Username or password is incorrect.");
        }

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
        header('Content-Type: application/json');

        if (!isset($_POST["username"])){
            return self::error_handle("Username is required!");
        }
        if (!isset($_POST["password"])){
            return self::error_handle("Password is required!");
        }
        if (!isset($_POST["register_token"])){
            return self::error_handle("Register_token is required!");
        }

        $username = $_POST["username"];
        $password = $_POST["password"];

        $check_username_answer = self::check_username($username);
        if ($check_username_answer !== 'OK'){
            return $check_username_answer;
        }

        $check_password_answer = self::check_password($password);
        if ($check_password_answer !== 'OK'){
            return $check_password_answer;
        }

        $user_model = new UsersModel();
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

    private static function check_username($username){
        $username_characters = "/[a-zA-Z0-9_]+/";
        preg_match($username_characters, $username, $match);
        if ($match[0] !== $username){
            $answer['success'] = false;
            $answer['error'] = "Username must have only letters, digits or '_'.";
            http_response_code(400);
            return json_encode($answer);
        }

        if (strlen($username) < 4 || strlen($username) > 30){
            $answer['success'] = false;
            $answer['error'] = "Username must have between 4 and 30 characters.";
            http_response_code(400);
            return json_encode($answer);
        }

        return 'OK';
    }

    private static function check_password($password){
        if (strlen($password) < 8 || strlen($password) > 30){
            $answer['success'] = false;
            $answer['error'] = "Password must have between 8 and 30 characters.";
            http_response_code(400);
            return json_encode($answer);
        }

        return 'OK';
    }

    public static function create_event(){
        header('Content-Type: application/json');

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
        $query_data["author_id"] = $user_id;

        $event_model = new EventModel();
        $answer = $event_model->create_event($query_data);

        if ($answer["success"] !== true){
            http_response_code(400);
        }
        else{
            http_response_code(201);
        }
        return json_encode($answer);
    }

    private static function extract_event_data(){
        $event_model = new EventModel();
        $columns = $event_model->get_columns_list();


        $data = (array) json_decode(file_get_contents('php://input'));
        $query_data = [];

        foreach ($columns as $column){
            if ($column == "id" || $column == "author_id")
                continue;
            if (isset($data[$column])){
                $query_data[$column] = $data[$column];
            }
        }

        return $query_data;
    }

    private static function create_event_validate_data(){
        $event_model = new EventModel();
        $columns = $event_model->get_columns_list();

//        foreach ($columns as $column)
//            if (isset($_REQUEST[$column])){
//                if ()
//            }
        return "OK";
    }

    public static function error_handle($message){
        http_response_code(400);

        $answer["success"] = "err";
        $answer["error_message"] = $message;

        return json_encode($answer);
    }
}