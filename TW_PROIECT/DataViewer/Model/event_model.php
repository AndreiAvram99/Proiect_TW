<?php

include("./../../Common/request.php");

class EventModel{
    private $root = "http://localhost/Proiect_TW/TW_PROIECT/DataFilter/Controller/data_filter.php";

    function get_events(){
        $query_param = $_SERVER["QUERY_STRING"];
        $url = $this->root . "/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $text = curl_exec($ch);
        return json_decode($text);
    }

    function get_column_list($column, $table){
        $url = $this->root .  "/events/columns?" . "column=" . $column;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $text = curl_exec($ch);
        return json_decode($text);
    }
}