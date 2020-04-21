<?php
include("event_controller.php");
include("pagination_controller.php");
include("../Model/event_model.php");

$current_page = 0;
if (isset($_GET["page_number"])){
    $current_page = $_GET["page_number"] - 1;
}
$events_per_page = 10;

$current_state = null;
if (isset($_GET["state"])){
    $current_state = $_GET["state"];
}
echo $current_state;

$current_county = null;
if (isset($_GET["county"])){
    $current_county = $_GET["county"];
}

$current_city = null;
if (isset($_GET["city"])){
    $current_city = $_GET["city"];
}

function get_self(){
    return "see_all_controller.php";
}

function load_events(){
    // to do: extrage numele autorului
    // to do: compune un titlu pentru eveniment
    $event_model = new EventModel();

    $from = $GLOBALS['current_page'] * $GLOBALS['events_per_page'];
    $count = $GLOBALS['events_per_page'];
    $events = $event_model->get_event($from, $count);
    foreach ($events as $event){
        $event_controller = new eventController($event["id"], $event["author_id"], $event["description"]);
        $event_controller->show();
    }
}

function load_pagination(){
    // to do: daca sunt multe butoane afiseaza doar primele, ultimele si mijloc.
    $event_model = new EventModel();

    $events_number = $event_model->get_number_of_events();
    $number_of_pages = ceil($events_number / $GLOBALS["events_per_page"]);

    for ($i = 0; $i < $number_of_pages; $i++){
        if ($i == $GLOBALS["current_page"])
            $is_active = "true";
        else
            $is_active = "false";
        $page_button = new pageButtonController(strval($i+1), $is_active);
        $page_button->show();
    }
}

include("./../View/see_all_view.php");