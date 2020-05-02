<?php
include("database_model.php");
include("filtered_query.php");

class EventModel
{
    private $conn = null;
    private $event_filtered_query;

    public function __construct(){
        $this->conn = Database::get_dbi()->get_conn();
    }

    function ref_values($arr){
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }

    public function instantiate_query_with_filters($columns){
        $this->event_filtered_query = new FilteredQuery($columns, "events");
    }

    public function add_in_filter($column, $list){
        $this->event_filtered_query->add_in_filter($column, $list);
    }

    public function add_between_filter($column, $first, $last){
        $this->event_filtered_query->add_between_filter($column, $first, $last);
    }

    public function add_order_criteria($list, $type){
        $this->event_filtered_query->add_order_criteria($list, $type);
    }

    public function execute_query_with_filters(){
        $sql = $this->event_filtered_query->get_sql_query();
        $result = $this->conn->query($sql);

        $events = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($events, $row);
            }
        }
        return $events;
    }

    // add filters to a sql command
    private function add_filters(&$sql_command, &$sql_types,  $filters){
        $number_of_filters = count($filters);

        $keys_array = array_keys($filters);

        for($index=0;$index < $number_of_filters; $index++){
            $sql_command = $sql_command . " AND " . $keys_array[$index] . "=? ";
            $sql_types = $sql_types . "s";
        }
    }
    
    // to do: add filters on get_event
    // return an array with "count" events starting index "from"
    public function get_event($from, $count, $filters){
        $values_array = array_values($filters);

        $sql_command = "SELECT * FROM events WHERE 1";
        $sql_types = "";
        $this->add_filters($sql_command,  $sql_types, $filters);
        $sql_command = $sql_command . " LIMIT ? OFFSET ?";
        $sql_types = $sql_types . "ii";


        $new_array = array();
        array_push($new_array, $sql_types);
        foreach ($values_array as $value){
            array_push($new_array, $value);
        }

        array_push($new_array, $count);
        array_push($new_array, $from);

        $stmt = $this->conn->prepare($sql_command);

        if (count($new_array) > 1)
            call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($new_array));


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

    public function get_number_of_events($filters){
        $values_array = array_values($filters);

        $sql_command = "SELECT COUNT('a') 'count' FROM events WHERE 1";
        $sql_types = "";
        $this->add_filters($sql_command,  $sql_types, $filters);

        $new_array = array();
        array_push($new_array, $sql_types);
        foreach ($values_array as $value){
            array_push($new_array, $value);
        }

        $stmt = $this->conn->prepare($sql_command);

        if (count($new_array) > 1)
            call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($new_array));

        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->fetch_assoc()["count"];
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

    public function create_event($author_id, $severity, $description, $start_time, $city, $county, $state, $distance, $side){

        $sql_command = "INSERT INTO events (
                                                author_id,
                                                severity,
                                                description,
                                                start_time,
                                                city,
                                                county,
                                                state,
                                                distance,
                                                side)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("iisssssds", $author_id,
            $severity,
            $description,
            $start_time,
            $city,
            $county,
            $state,
            $distance,
            $side);
        $stmt->execute();
        $stmt->close();
    }
}