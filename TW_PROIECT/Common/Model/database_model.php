<?php
class Database{
    private static $dbi_instance = null;
    private $mysql = null;

    public static function get_dbi(){
        if (Database::$dbi_instance == null){
            Database::$dbi_instance = new Database();
        }
        return Database::$dbi_instance;
    }

    public function get_conn(){
        return $this->mysql;
    }

    private function __construct(){
        $username = database_username;
        $password = database_password;
        $database_name = database_name;

        $this->mysql = new mysqli (
            'localhost', // locatia serverului
            $username,       // numele de cont
            $password,    // parola
            $database_name   // baza de date
        );

        if (mysqli_connect_errno()) {
            die ('Conexiunea a esuat...');
        }
    }

    function __destruct(){
        $this->mysql->close();
    }
}