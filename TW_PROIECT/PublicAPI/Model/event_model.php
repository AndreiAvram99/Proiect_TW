<?php

include("./../../../config.php");

class EventModel
{
    function get_column_list($column){
        $url = data_filter_root .  "/v1/events/columns/" . $column;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    function get_columns_list(){
        $url = data_filter_root .  "/v1/events/columns";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true)['columns'];
    }

    function get_events(){
        $query_param = $_SERVER["QUERY_STRING"];
        $url = data_filter_root . "/v1/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }
}