<?php

$states = [];
$counties = [];
$cities = [];


function init_states(){
    $event_model = new EventModel();
    $GLOBALS["states"] = $event_model->get_column_list("state", "events");
    foreach ($GLOBALS["states"] as &$state){
        $state = str_replace(' ', '-',$state);
    }
}

// to do: daca e selectat un stat sa iti dea doar judetele din el
function init_counties(){
    $event_model = new EventModel();
    $GLOBALS["counties"] = $event_model->get_column_list("county", "events");
    foreach ($GLOBALS["counties"] as &$county){
        $county = str_replace(' ', '-',$county);
    }
}

// to do: daca e un judet selectat, sa iti dea doar orasele din el
function init_cities(){
    $event_model = new EventModel();
    $GLOBALS["cities"] = $event_model->get_column_list("city", "events");
    foreach ($GLOBALS["cities"] as &$city){
        $city = str_replace(' ', '-',$city);
    }
}

include("../View/filter_menu_view.php");