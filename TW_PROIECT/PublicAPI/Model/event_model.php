<?php

include("./../../../config.php");

class EventModel
{
    function get_column_list($column, $table){
        $url = data_filter_root .  "/events/columns?" . "column=" . $column;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true);
    }
}