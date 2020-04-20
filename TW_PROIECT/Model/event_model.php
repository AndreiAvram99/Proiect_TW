<?php
include("database_model.php");

class eventModel
{
    private $conn = null;

    public function __construct(){
        $this->conn = database::get_dbi()->get_conn();
    }

    // to do: add filters on get_event
    // return an array with "count" events starting index "from"
    public function get_event($from, $count){
        $sql_command = "SELECT * FROM events ORDER BY id LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("ii", $count, $from);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $events = array();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $new_event = array(
                                "id" => $row["id"],
                                "author_id" => $row["author_id"],
                                "severity" => $row["severity"],
                                "description" => $row["description"],
                                "start_time" => $row["start_time"],
                                "city" => $row["city"],
                                "county" => $row["county"],
                                "state" => $row["state"]
                            );
                array_push($events, $new_event);
            }
        }

        return $events;
    }

    public function get_number_of_events(){
        $sql_command = "SELECT COUNT('a') 'count' FROM events";
        return $this->conn->query($sql_command)->fetch_assoc()["count"];
    }

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

        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("iisssss", $author_id,
            $severity,
            $description,
            $start_time,
            $city,
            $county,
            $state);
        $stmt->execute();
        $stmt->close();
    }
}