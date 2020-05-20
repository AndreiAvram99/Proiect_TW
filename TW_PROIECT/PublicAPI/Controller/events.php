<?php
include_once("./../Model/event_model.php");
include("chart_controller.php");

class Events
{
    /**
     * Return a chart specified in $parameters. Returned type will be the one
     * from $_REQUEST['type']
     * @param $parameters
     * @return false|mixed|string
     */
    static function get_statistics(){
        header('Content-Type: application/json');

        if (!isset($_REQUEST['type'])){
            $answer['success'] = false;
            $answer['error'] = "Type attribute is necessary.";
            http_response_code(400);
            return json_encode($answer);
        }
        if (!isset($_REQUEST['column'])){
            $answer['success'] = false;
            $answer['error'] = "Column attribute is necessary.";
            http_response_code(400);
            return json_encode($answer);
        }

        $type = $_REQUEST['type'];
        $column = $_REQUEST['column'];

        $check_column_answer = self::check_column($column);
        if ($check_column_answer !== 'OK'){
            return $check_column_answer;
        }


        if ($type == 'count'){
            create_by_number_of_accidents($column);
            $answer['success'] = true;
            $answer['data'] = file_get_contents('../RESOURCES/CSV/chart_data.CSV');
            return json_encode($answer);
        }
        else if ($type == 'average'){
            if (!isset($_REQUEST['mean_column'])){
                $answer['success'] = false;
                $answer['error'] = "Average type require mean_column attribute.";
                http_response_code(400);
                return json_encode($answer);
            }
            $mean_column = $_REQUEST['mean_column'];
            $check_column_answer = self::check_column($mean_column);
            if ($check_column_answer !== 'OK'){
                return $check_column_answer;
            }
            create_by_mean($column, $mean_column);

            $answer['success'] = true;
            $answer['data'] = file_get_contents('../RESOURCES/CSV/chart_data.CSV');
            return json_encode($answer);
        }
        else{
            $answer['success'] = false;
            $answer['error'] = "Bad type.";
            http_response_code(400);
            return json_encode($answer);
        }
    }

    private static function check_column($column){
        $column_characters = "/[a-zA-Z0-9_]+/";
        if (!preg_match($column_characters, $column)){
            $answer['success'] = false;
            $answer['error'] = "Illegal characters in column.";
            http_response_code(400);
            return json_encode($answer);
        }

        $event_model = new EventModel();
        $columns = $event_model->get_columns_list();

        if (!in_array($column, $columns)){
            $answer['success'] = false;
            $answer['error'] = "There is no column " . $column;
            http_response_code(400);
            return json_encode($answer);
        }
        return 'OK';
    }

    /**
     * Return filtered events according to certain parameters as JSON.
     */
    static function get_events(){
        header('Content-Type: application/json');

        $accepted_types = ["JSON"];
        if (isset($_REQUEST['type']) && in_array(strtoupper($_REQUEST['type']), $accepted_types))
            $type = strtoupper($_REQUEST['type']);
        else
            $type = "JSON";

        if ($type = "JSON"){
            return Events::get_events_as_JSON();
        }
    }

    static function get_events_as_JSON(){
        $event_model = new EventModel();
        $events['events'] = $event_model->get_events();

        $answer['success'] = true;
        $answer['data'] = $events;
        return json_encode($answer);
    }

    /**
     * Returns all distinct elements which are in table "events" on column $parameters[0]
     * Returned format is JSON.
     * If the column dosen't exist. Return a string "There is no column columnName";
     * @param $parameters
     * @return false|string
     */
    static function get_column($parameters){
        header('Content-Type: application/json');

        $event_model = new EventModel();
        $column = $parameters[0];
        $columns = $event_model->get_columns_list();

        if (!in_array($column, $columns)){
            $answer['success'] = false;
            $answer['error'] = "There is no column " . $column;
            http_response_code(400);
            return json_encode($answer);
        }

        $answer['success'] = true;
        $answer['data'][$column] = $event_model->get_column_list($column);
        return json_encode($answer);
    }

    /**
     * Return the list of columns as JSON.
     * @return false|string
     */
    static function get_columns_list(){
        header('Content-Type: application/json');

        $event_model = new EventModel();
        $answer['success'] = true;
        $answer['data'] = $event_model->get_columns_list();
        return json_encode($answer);
    }
}