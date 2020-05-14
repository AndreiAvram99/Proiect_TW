<?php

class EventModel
{
    function get_columns_list(){
        $url = data_filter_root .  "/v1/events/columns";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $text = curl_exec($ch);
        return json_decode($text, true)['columns'];
    }

}