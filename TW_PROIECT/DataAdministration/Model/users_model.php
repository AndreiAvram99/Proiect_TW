<?php

include("./../../Common/Model/database_model.php");

class UsersModel
{
    private $conn = null;

    public function __construct(){
        $this->conn = Database::get_dbi()->get_conn();
    }

    public function get_password_for($username){
        $sql_command = "SELECT password FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $passwords = array();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($passwords, $row);
            }
        }

        if (empty($passwords))
            return null;
        return $passwords[0]["password"];
    }

    public function get_states_list(){
        $sql_command = "SELECT DISTINCT state FROM events ORDER BY state ASC";
        $result = $this->conn->query($sql_command);

        $states = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($states, $row["state"]);
            }
        }
        return $states;
    }
}