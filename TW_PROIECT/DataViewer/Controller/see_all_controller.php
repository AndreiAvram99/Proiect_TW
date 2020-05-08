<?php
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
//
//$current_state = null;
//if (isset($_REQUEST["state"]) && $_REQUEST["state"] != "all"){
//    $current_state = $_REQUEST["state"];
//}
//
//$current_county = null;
//if (isset($_REQUEST["county"]) && $_REQUEST["county"] != "all"){
//    $current_county = $_REQUEST["county"];
//}
//
//$current_city = null;
//if (isset($_REQUEST["city"]) && $_REQUEST["city"] != "all"){
//    $current_city = $_REQUEST["city"];
//}
//
//$start_date = null;
//if (isset($_REQUEST["start_date"])){
//    $start_date =  $_REQUEST["start_date"];
//}
//
//$end_date = null;
//if (isset($_REQUEST["end_date"])){
//    $end_date = $_REQUEST["end_date"];
//}

function get_self(){
    return "see_all_controller.php";
}
//
//function add_filters($event_model){
//    if ($GLOBALS["current_state"] != null)
//        $event_model->add_in_filter("state", [$GLOBALS["current_state"]]);
//    if ($GLOBALS["current_county"] != null)
//        $event_model->add_in_filter("county", [$GLOBALS["current_county"]]);
//    if ($GLOBALS["current_city"] != null)
//        $event_model->add_in_filter("city", [$GLOBALS["current_city"]]);
//    if ($GLOBALS["start_date"] != null && $GLOBALS["end_date"] != null) {
//        $event_model->add_between_filter("start_time", $GLOBALS["start_date"], $GLOBALS["end_date"]);
//    }
//}
//
//function add_orders($event_model){
//    if(isset($_REQUEST["sort_by_date"]) && $_REQUEST["sort_by_date"] != "none"){
//        $type = $_REQUEST["sort_by_date"];
//        $event_model->add_order_criteria(["start_time"], $type);
//    }
//
//    if(isset($_REQUEST["sort_by_state"]) && $_REQUEST["sort_by_state"] != "none"){
//        $type = $_REQUEST["sort_by_state"];
//        $event_model->add_order_criteria(["state"], $type);
//    }
//}

function get_events(){
    $event_model = new EventModel();
    return $event_model->get_events();
}

function load_events(){
    // to do: extrage numele autorului

    $from = $GLOBALS['current_page'] * $GLOBALS['events_per_page'];
    $count = $GLOBALS['events_per_page'];

//    $event_model->instantiate_query_with_filters(["*"]);
//    add_filters($event_model);
//    add_orders($event_model);
//    $event_model->add_limits($from, $count);
//    $events = $event_model->execute_query_with_filters();

    $events = get_events();
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

    $event_model->instantiate_query_with_filters(["COUNT('a')"]);
    add_filters($event_model);
    $event_model->add_limits(0, 100000000);
    $events_number = $event_model->execute_query_with_filters()[0]["COUNT('a')"];

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
