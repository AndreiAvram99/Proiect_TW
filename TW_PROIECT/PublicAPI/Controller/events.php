<?php
include("./../Model/event_model.php");

class Events
{
    /**
     * Return all distinct elements which are in table "events" on column $parameters[0]
     * Returned format is JSON.
     * If the column dosen't exist. Return a string "There is no column columnName";
     * @param $parameters
     * @return false|string
     */
    static function get_column($parameters){
        $event_model = new EventModel();
        $column = $parameters[0];
        $columns = $event_model->get_columns_list();

        if (!in_array($column, $columns)){
            $answer['error'] = "There is no column " . $column;
            return json_encode($answer);
        }

        $answer[$column] = $event_model->get_column_list($column);
        return json_encode($answer);
    }

    /**
     * Return the list of columns as JSON.
     * @return false|string
     */
    static function get_columns_list(){
        $event_model = new EventModel();
        return json_encode($event_model->get_columns_list());
    }
}