<?php
include("./../../Common/request.php");

class EventModel{
    private $root = data_filter_root;

    function get_events(){
        $query_param = $_SERVER["QUERY_STRING"];
        $url = $this->root . "/v1/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    function get_events_with_limits($from, $count){
        $query_param = $_SERVER["QUERY_STRING"];
        if (!empty($query_param))
            $query_param .= "&";
        $query_param .= "limits_from=" . $from;
        $query_param .= "&limits_count=" . $count;

        $url = $this->root . "/v1/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    function get_column_list($column, $table){
        $url = $this->root .  "/events/columns/" . $column;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    // return the number of events with filters from _REQUEST
    function get_count(){
        $query_param = $_SERVER["QUERY_STRING"];
        if (!empty($query_param))
            $query_param .= "&";
        $query_param .= "columns[]=COUNT('a')";
        $query_param .= "&limits_from=0";
        $query_param .= "&limits_count=100000000";

        $url = $this->root . "/v1/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true)[0]["COUNT('a')"];
    }
}