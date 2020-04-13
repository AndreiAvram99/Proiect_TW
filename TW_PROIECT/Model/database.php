<?php
include('./../../config.php');

class database{
    private static $dbi_instance = null;
    private $mysql = null;

    public static function get_dbi(){
        if (database::$dbi_instance == null){
            database::$dbi_instance = new database();
        }
        return database::$dbi_instance;
    }

    private function __construct(){
        $username = $GLOBALS['database_username'];
        $password = $GLOBALS['database_password'];

        $this->mysql = new mysqli (
            'localhost', // locatia serverului
            $username,       // numele de cont
            $password,    // parola
            'tw_project'   // baza de date
        );

        if (mysqli_connect_errno()) {
            die ('Conexiunea a esuat...');
        }
    }

    // to do: extrage datele(event)

    public function create_event($author_id, $severity, $description, $start_time, $city, $county, $state){
        $sql_command = "INSERT INTO events (
                                                author_id,
                                                severity,
                                                description,
                                                start_time,
                                                city,
                                                county,
                                                state)
                                            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysql->prepare($sql_command);
        $stmt->bind_param("iisssss", $bind_author_id,
                                            $bind_severity,
                                                $bind_description,
                                                $bind_start_time,
                                                $bind_city,
                                                $bind_county,
                                                $bind_state);
        $bind_author_id = $author_id;
        $bind_severity = $severity;
        $bind_description = $description;
        $bind_start_time = $start_time;
        $bind_city = $city;
        $bind_county = $county;
        $bind_state = $state;
        $stmt->execute();
        $stmt->close();
    }

    function __destruct(){
        $this->mysql->close();
    }
}