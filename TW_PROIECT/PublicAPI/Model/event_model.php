<?php

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

    function count_events_group_by_column($column){
        $url = data_filter_root .  "/v1/events/count?" . "column=" . $column ;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    function get_events(){
        $query_param = $_SERVER["QUERY_STRING"];
        $url = data_filter_root . "/v1/events?" . $query_param;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }

    function mean_column_group_by_other_column($mean_column, $group_column, $table){
        $url = data_filter_root .  "/v1/events/mean?" . "mean_column=" . $mean_column . "&group_column=".$group_column;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }
}