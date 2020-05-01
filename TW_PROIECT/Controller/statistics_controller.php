<?php
include("../Model/event_model.php");
include("filter_container_controller.php");

$event_model = new EventModel();

function add_container($name, $title, $content_list){
   
    $container = new FilterContainer($name, $title);

    foreach($content_list as $row){
        $container->add_row($row);
    }

    $container->show();

} 

function load_states_container(){
    
    $states_list =  $GLOBALS['event_model']->get_states_list();
    add_container("states_container", "Choose state", $states_list);
}

function load_counties_container(){

    $counties_list =  $GLOBALS['event_model']->get_counties_list();
    add_container("counties_container", "Choose county", $counties_list);
}

function load_cities_container(){

    $cities_list =  $GLOBALS['event_model']->get_cities_list();
    add_container("cities_container", "Choose city", $cities_list);
}

function load_sides_container(){

    $sides_list = ["L", "R"];
    add_container("sides_container", "Choose side of accident", $sides_list);
}

function load_severities_container(){

    $severities_list = [ "1", "2", "3", "4", "5" ];
    add_container("severities_container", "Choose severity", $severities_list);
}

function load_chart_types_container(){
    $chart_types_list = [ "pie-chart", "bar-plot", "graph"];
    add_container("chart_types_container", "Choose chart type", $chart_types_list);
}

include("./../View/statistics_view.php");
