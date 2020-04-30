<?php
include("../Model/event_model.php");
include("filter_container_controller.php");

$event_model = new EventModel();

function add_container($name, $content_list){
   
    $container = new FilterContainer($name);

    foreach($content_list as $row){
        $container->add_row($row);
    }

    $container->show();

} 

function load_states_container(){
    
    $states_list =  $GLOBALS['event_model']->get_states_list();
    add_container("states_container", $states_list);
}

function load_counties_container(){

    $counties_list =  $GLOBALS['event_model']->get_counties_list();
    add_container("counties_container", $counties_list);
}

function load_cities_container(){

    $cities_list =  $GLOBALS['event_model']->get_cities_list();
    add_container("cities_container", $cities_list);
}

function load_sides_container(){

    $sides_list = ["L", "R"];
    add_container("sides_container", $sides_list);
}

function load_severities_container(){

    $severities_list = [ "1", "2", "3", "4", "5" ];
    add_container("severities_container", $severities_list);
}

include("./../View/statistics_view.php");
