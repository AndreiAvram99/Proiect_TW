<?php
include_once("./../../../config.php");
include("event_controller.php");
include("../Model/event_model.php");

$event_model = new EventModel();
$events = $event_model->get_events();

function create_event(){
    $event = new eventController("titlu", "autor", "ceva descriere");
    $event->show();
}



include("ranking_controller.php");
function get_ranking(){
    $ranking = new Ranking();
    $ranking->show();
}

function get_nb_of_accidents($state){
    
    $nb_of_accidents = 0;
    foreach($GLOBALS['events'] as $event){
        if($event['state'] == $state)
        $nb_of_accidents++;
    }
    return $nb_of_accidents;
}

function create_map_data(){
    $strJsonFileContents = file_get_contents("./../RESOURCES/JSON/map_data.json");
    $array = json_decode($strJsonFileContents, true);
    
    for($i = 0 ; $i < sizeof($array['features']) ; $i++){
        $array['features'][$i]['properties']['accidents_per_state'] = get_nb_of_accidents($array['features'][$i]['properties']['short_name']);
    }
  
    $json_obj = json_encode($array, JSON_PRETTY_PRINT);
    file_put_contents("./../RESOURCES/JSON/map_data.json", $json_obj);
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

include("./../View/index_view.php");
