<?php

$states = [];
$counties = [];
$cities = [];


function init_states(){
    $event_model = new EventModel();
    $GLOBALS["states"] = $event_model->get_column_list("state", "events");
}

// to do: daca e selectat un stat sa iti dea doar judetele din el
function init_counties(){
    $event_model = new EventModel();
    $GLOBALS["counties"] = $event_model->get_column_list("county", "events");
}

// to do: daca e un judet selectat, sa iti dea doar orasele din el
function init_cities(){
    $event_model = new EventModel();
    $GLOBALS["cities"] = $event_model->get_column_list("city", "events");
}

include("../View/filter_menu_view.php");