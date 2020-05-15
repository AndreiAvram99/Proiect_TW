<?php
include_once("./../../Common/Model/database_model.php");
include_once("filtered_query.php");

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

    public function add_limits($from, $count){
        $this->event_filtered_query->add_limits($from, $count);
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
//    private function add_filters(&$sql_command, &$sql_types,  $filters){
//        $number_of_filters = count($filters);
//
//        $keys_array = array_keys($filters);
//
//        for($index=0;$index < $number_of_filters; $index++){
//            $sql_command = $sql_command . " AND " . $keys_array[$index] . "=? ";
//            $sql_types = $sql_types . "s";
//        }
//    }
//
    // to do: add filters on get_event
    // return an array with "count" events starting index "from"
//    public function get_event($from, $count, $filters){
//        $values_array = array_values($filters);
//
//        $sql_command = "SELECT * FROM events WHERE 1";
//        $sql_types = "";
//        $this->add_filters($sql_command,  $sql_types, $filters);
//        $sql_command = $sql_command . " LIMIT ? OFFSET ?";
//        $sql_types = $sql_types . "ii";
//
//
//        $new_array = array();
//        array_push($new_array, $sql_types);
//        foreach ($values_array as $value){
//            array_push($new_array, $value);
//        }
//
//        array_push($new_array, $count);
//        array_push($new_array, $from);
//
//        $stmt = $this->conn->prepare($sql_command);
//
//        if (count($new_array) > 1)
//            call_user_func_array(array($stmt, 'bind_param'), $this->ref_values($new_array));
//
//
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $stmt->close();
//
//
//        $events = array();
//        if ($result->num_rows > 0){
//            while ($row = $result->fetch_assoc()){
//                $new_event = array(
//                                "id" => $row["id"],
//                                "author_id" => $row["author_id"],
//                                "severity" => $row["severity"],
//                                "description" => $row["description"],
//                                "start_time" => $row["start_time"],
//                                "city" => $row["city"],
//                                "county" => $row["county"],
//                                "state" => $row["state"]
//                            );
//                array_push($events, $new_event);
//            }
//        }
//
//        return $events;
//    }

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

    public function get_last_event_for($user_id){
        $sql_command = "SELECT * FROM events WHERE author_id = ? ORDER BY id desc LIMIT 1";
        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $events = array();
        while ($row = $result->fetch_assoc()){
            array_push($events, $row);
        }
        return $events[0];
    }
    
    public function get_column_list($column, $table){
        $sql_command = "SELECT DISTINCT ".$column." FROM ".$table." WHERE ".$column." IS NOT NULL " ." ORDER BY ".$column." ASC " ;
        $result = $this->conn->query($sql_command);
        
        $column_list = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($column_list, $row[$column]);
            }
        }
        return $column_list;
    }

    public function mean_column_group_by_other_column($mean_column, $group_column, $table){
        $sql_command = "SELECT ".$group_column.", AVG(".$mean_column.") AS mean FROM ".$table." GROUP BY ".$group_column;
        $result = $this->conn->query($sql_command);
        
        $avg_dict = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($avg_dict, $row);
            }
        }
        return $avg_dict;
    }

    public function get_columns_list(){
        $sql_command = "SELECT COLUMN_NAME FROM information_schema.columns 
                            WHERE table_schema='tw_project' AND table_name='events'";
        $result = $this->conn->query($sql_command);

        $columns_list = [];
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                array_push($columns_list, $row['COLUMN_NAME']);
            }
        }
        return $columns_list;
    }

//    public function get_states_list(){
//        $sql_command = "SELECT DISTINCT state FROM events ORDER BY state ASC";
//        $result = $this->conn->query($sql_command);
//
//        $states = [];
//        if ($result->num_rows > 0){
//            while ($row = $result->fetch_assoc()){
//                array_push($states, $row["state"]);
//            }
//        }
//        return $states;
//    }
//
//    public function get_counties_list(){
//        $sql_command = "SELECT DISTINCT county FROM events ORDER BY county ASC";
//        $result = $this->conn->query($sql_command);
//
//        $counties = [];
//        if ($result->num_rows > 0){
//            while ($row = $result->fetch_assoc()){
//                array_push($counties, $row["county"]);
//            }
//        }
//        return $counties;
//    }
//
//    public function get_cities_list(){
//        $sql_command = "SELECT DISTINCT city FROM events ORDER BY city ASC";
//        $result = $this->conn->query($sql_command);
//
//        $cities = [];
//        if ($result->num_rows > 0){
//            while ($row = $result->fetch_assoc()){
//                array_push($cities, $row["city"]);
//            }
//        }
//        return $cities;
//    }

    public function create_event_from_dict($dict){
        $author_id = null;
        $source = null;
        $severity = null;
        $description = null;
        $start_time = null;
        $start_lat = null;
        $start_lng = null;
        $city = null;
        $county = null;
        $state = null;
        $distance = null;
        $street_nb = null;
        $street_name = null;
        $side = null;
        $timezone = null;
        $airport_code = null;
        $temperature = null;
        $wind_chill = null;
        $humidity = null;
        $pressure = null;
        $visibility = null;
        $wind_direction = null;
        $wind_speed = null;
        $precipitation = null;
        $weather_condition = null;
        $amenity = null;
        $bump = null;
        $crossing = null;
        $give_way = null;
        $junction = null;
        $no_exit = null;
        $railway = null;
        $roundabout = null;
        $station = null;
        $stop = null;
        $traffic_calming = null;
        $traffic_signal = null;
        $turn_loop = null;
        $sunrise_sunset = null;
        $civil_twilight = null;
        $nautical_twilight = null;
        $astronomical_twilight = null;
        if (isset($dict["author_id"])) $author_id = $dict["author_id"];
        if (isset($dict["source"])) $source = $dict["source"];
        if (isset($dict["severity"])) $severity = $dict["severity"];
        if (isset($dict["description"])) $description = $dict["description"];
        if (isset($dict["start_time"])) $start_time = $dict["start_time"];
        if (isset($dict["start_lat"])) $start_lat = $dict["start_lat"];
        if (isset($dict["start_lng"])) $start_lng = $dict["start_lng"];
        if (isset($dict["city"])) $city = $dict["city"];
        if (isset($dict["county"])) $county = $dict["county"];
        if (isset($dict["state"])) $state = $dict["state"];
        if (isset($dict["distance"])) $distance = $dict["distance"];
        if (isset($dict["street_nb"])) $street_nb = $dict["street_nb"];
        if (isset($dict["street_name"])) $street_name = $dict["street_name"];
        if (isset($dict["side"])) $side = $dict["side"];
        if (isset($dict["timezone"])) $timezone = $dict["timezone"];
        if (isset($dict["airport_code"])) $airport_code = $dict["airport_code"];
        if (isset($dict["temperature"])) $temperature = $dict["temperature"];
        if (isset($dict["wind_chill"])) $wind_chill = $dict["wind_chill"];
        if (isset($dict["humidity"])) $humidity = $dict["humidity"];
        if (isset($dict["pressure"])) $pressure = $dict["pressure"];
        if (isset($dict["visibility"])) $visibility = $dict["visibility"];
        if (isset($dict["wind_direction"])) $wind_direction = $dict["wind_direction"];
        if (isset($dict["wind_speed"])) $wind_speed = $dict["wind_speed"];
        if (isset($dict["precipitation"])) $precipitation = $dict["precipitation"];
        if (isset($dict["weather_condition"])) $weather_condition = $dict["weather_condition"];
        if (isset($dict["amenity"])) $amenity = $dict["amenity"];
        if (isset($dict["bump"])) $bump = $dict["bump"];
        if (isset($dict["crossing"])) $crossing = $dict["crossing"];
        if (isset($dict["give_way"])) $give_way = $dict["give_way"];
        if (isset($dict["junction"])) $junction = $dict["junction"];
        if (isset($dict["no_exit"])) $no_exit = $dict["no_exit"];
        if (isset($dict["railway"])) $railway = $dict["railway"];
        if (isset($dict["roundabout"])) $roundabout = $dict["roundabout"];
        if (isset($dict["station"])) $station = $dict["station"];
        if (isset($dict["stop"])) $stop = $dict["stop"];
        if (isset($dict["traffic_calming"])) $traffic_calming = $dict["traffic_calming"];
        if (isset($dict["traffic_signal"])) $traffic_signal = $dict["traffic_signal"];
        if (isset($dict["turn_loop"])) $turn_loop = $dict["turn_loop"];
        if (isset($dict["sunrise_sunset"])) $sunrise_sunset = $dict["sunrise_sunset"];
        if (isset($dict["civil_twilight"])) $civil_twilight = $dict["civil_twilight"];
        if (isset($dict["nautical_twilight"])) $nautical_twilight = $dict["nautical_twilight"];
        if (isset($dict["astronomical_twilight"])) $astronomical_twilight = $dict["astronomical_twilight"];
        return $this->create_event($author_id,
                            $source,
                            $severity,
                            $description,
                            $start_time,
                            $start_lat,
                            $start_lng,
                            $city,
                            $county,
                            $state,
                            $distance,
                            $street_nb,
                            $street_name,
                            $side,
                            $timezone,
                            $airport_code,
                            $temperature,
                            $wind_chill,
                            $humidity,
                            $pressure,
                            $visibility,
                            $wind_direction,
                            $wind_speed,
                            $precipitation,
                            $weather_condition,
                            $amenity,
                            $bump,
                            $crossing,
                            $give_way,
                            $junction,
                            $no_exit,
                            $railway,
                            $roundabout,
                            $station,
                            $stop,
                            $traffic_calming,
                            $traffic_signal,
                            $turn_loop,
                            $sunrise_sunset,
                            $civil_twilight,
                            $nautical_twilight,
                            $astronomical_twilight);
    }

    public function create_event($author_id, 
                                 $source = null,
                                 $severity = null,
                                 $description = null,
                                 $start_time = null,
                                 $start_lat = null,
                                 $start_lng = null,
                                 $city = null,
                                 $county = null,
                                 $state = null,
                                 $distance = null,
                                 $street_nb = null,
                                 $street_name = null,
                                 $side = null,
                                 $timezone = null,
                                 $airport_code = null,
                                 $temperature = null,
                                 $wind_chill = null,
                                 $humidity = null,
                                 $pressure = null,
                                 $visibility = null,
                                 $wind_direction = null,
                                 $wind_speed = null,
                                 $precipitation = null,
                                 $weather_condition = null,
                                 $amenity = null,
                                 $bump = null,
                                 $crossing = null,
                                 $give_way = null,
                                 $junction = null,
                                 $no_exit = null,
                                 $railway = null,
                                 $roundabout = null,
                                 $station = null,
                                 $stop = null,
                                 $traffic_calming = null,
                                 $traffic_signal = null,
                                 $turn_loop = null,
                                 $sunrise_sunset = null,
                                 $civil_twilight = null,
                                 $nautical_twilight = null,
                                 $astronomical_twilight = null){

        $sql_command = "INSERT INTO events (
                                                author_id,
                                                source,
                                                severity,
                                                description,
                                                start_time,
                                                start_lat,
                                                start_lng,
                                                city,
                                                county,
                                                state,
                                                distance,
                                                street_nb,
                                                street_name,
                                                side,
                                                timezone,
                                                airport_code,
                                                temperature,
                                                wind_chill,
                                                humidity,
                                                pressure,
                                                visibility,
                                                wind_direction,
                                                wind_speed,
                                                precipitation,
                                                weather_condition,
                                                amenity,
                                                bump,
                                                crossing,
                                                give_way,
                                                junction,
                                                no_exit,
                                                railway,
                                                roundabout,
                                                station,
                                                stop,
                                                traffic_calming,
                                                traffic_signal,
                                                turn_loop,
                                                sunrise_sunset,
                                                civil_twilight,
                                                nautical_twilight,
                                                astronomical_twilight)
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql_command);
        $stmt->bind_param("isissddsssdissssdddddsddsiiiiiiiiiiiiissss", $author_id,
                                                                        $source, 
                                                                        $severity, 
                                                                        $description, 
                                                                        $start_time, 
                                                                        $start_lat, 
                                                                        $start_lng, 
                                                                        $city, 
                                                                        $county, 
                                                                        $state, 
                                                                        $distance, 
                                                                        $street_nb,
                                                                        $street_name,
                                                                        $side,
                                                                        $timezone,
                                                                        $airport_code,
                                                                        $temperature,
                                                                        $wind_chill,
                                                                        $humidity,
                                                                        $pressure,
                                                                        $visibility,
                                                                        $wind_direction,
                                                                        $wind_speed,
                                                                        $precipitation,
                                                                        $weather_condition,
                                                                        $amenity,
                                                                        $bump,
                                                                        $crossing,
                                                                        $give_way,
                                                                        $junction,
                                                                        $no_exit,
                                                                        $railway,
                                                                        $roundabout,
                                                                        $station,
                                                                        $stop,
                                                                        $traffic_calming,
                                                                        $traffic_signal,
                                                                        $turn_loop,
                                                                        $sunrise_sunset,
                                                                        $civil_twilight,
                                                                        $nautical_twilight,
                                                                        $astronomical_twilight);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}