<?php

include("./../../Common/Model/database_model.php");

class UsersModel
{
    private $conn = null;

    public function __construct(){
        $this->conn = Database::get_dbi()->get_conn();
    }

    public function get_password_for($username){
        $user = $this->get_user_by_username($username);
        if (empty($user))
            return null;
        return $user["password"];
    }

    public function get_user_id($username){
        $user = $this->get_user_by_username($username);
        if (empty($user))
            return null;
        return $user["id"];
    }

    public function get_user_by_username($username){
        $sql_command = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $users = array();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($users, $row);
            }
        }

        if (empty($users))
            return null;
        return $users[0];
    }

    public function create_user($username, $password){
        $sql_command = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("ss", $username, $password);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}