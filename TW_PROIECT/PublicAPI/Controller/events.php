<?php
include("./../Model/event_model.php");

class Events
{
    static function get_column($parameters){
        $event_model = new EventModel();
        $column = $parameters[0];
        return json_encode($event_model->get_column_list($column, "events"));
    }
}