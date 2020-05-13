<?php
include("./../../../config.php");
include("event_controller.php");
include("pagination_controller.php");
include("../Model/event_model.php");

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

//Globals
$current_page = 0;
$events_per_page = 10;

if (isset($_REQUEST["page_number"])){
    $current_page = $_REQUEST["page_number"] - 1;
}

function get_self(){
    return "see_all_controller.php";
}

function load_events(){
    $from = $GLOBALS['current_page'] * $GLOBALS['events_per_page'];
    $count = $GLOBALS['events_per_page'];

    $event_model = new EventModel();
    $events = $event_model->get_events_with_limits($from, $count);
    foreach ($events as $event){
        $event_title = "Accdinent happen in ".$event["state"].", city: ".$event["city"].", date: ".$event["start_time"];
        $event_controller = new eventController($event_title, $event["author_id"], $event["description"]);
        $event_controller->set_id($event["id"]);
        $event_controller->show();
    }
}

function load_page($index){
    if ($index == $GLOBALS["current_page"])
        $is_active = "true";
    else
        $is_active = "false";
    $page_button = new pageButtonController(strval($index+1), $is_active, false);
    $page_button->show();

}

function load_separator_button(){
    $page_button = new pageButtonController("...", "false", true);
    $page_button->show();
}

function load_pagination(){
    // to do: daca sunt multe butoane afiseaza doar primele, ultimele si mijloc.
    $event_model = new EventModel();

    $events_number = $event_model->get_count();
    $number_of_pages = ceil($events_number / $GLOBALS["events_per_page"]);

    if ($number_of_pages <= 7) {
        for ($i = 0; $i < $number_of_pages; $i++) {
            load_page($i);
        }
    }
    else{
        $current_page = $GLOBALS["current_page"];

        if ($current_page < 3){
            for ($i=0;$i<4;$i++)
                load_page($i);

            load_separator_button();

            load_page($number_of_pages - 1);
        }
        else if($current_page >= $number_of_pages - 3){
            load_page(0);

            load_separator_button();

            for ($i=$number_of_pages - 4;$i<$number_of_pages;$i++)
                load_page($i);
        }
        else{
            load_page(0);

            load_separator_button();

            for ($i=$current_page-1;$i<=$current_page+1;$i++)
                load_page($i);

            load_separator_button();

            load_page($number_of_pages - 1);
        }
    }
}

include("./../View/see_all_view.php");
