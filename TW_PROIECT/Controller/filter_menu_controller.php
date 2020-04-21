<?php

$states = [];
$counties = [];
$cities = [];

// to do: verifica daca butonul de submit a fost apasat

function init_states(){
    $event_model = new EventModel();
    $GLOBALS["states"] = $event_model->get_states_list();
}

// to do: daca e selectat un stat sa iti dea doar judetele din el
function init_counties(){
    $event_model = new EventModel();
    $GLOBALS["counties"] = $event_model->get_counties_list();
}

// to do: daca e un judet selectat, sa iti dea doar orasele din el
function init_cities(){
    $event_model = new EventModel();
    $GLOBALS["cities"] = $event_model->get_cities_list();
}

include("../View/filter_menu_view.php");