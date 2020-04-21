<?php
include("database_model.php");

class EventModel
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

    public function get_counties_list(){
        $sql_command = "SELECT DISTINCT county FROM events ORDER BY county ASC";
        $result = $this->conn->query($sql_command);

        $counties = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($counties, $row["county"]);
            }
        }
        return $counties;
    }

    public function get_cities_list(){
        $sql_command = "SELECT DISTINCT city FROM events ORDER BY city ASC";
        $result = $this->conn->query($sql_command);

        $cities = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($cities, $row["city"]);
            }
        }
        return $cities;
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