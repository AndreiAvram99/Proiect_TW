<?php
include("../Model/event_model.php");
include("filter_container_controller.php");
include("chart_container_controller.php");

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
    $chart_types_list = [ "Pie-chart", "Bar-plot-chart", "Lollipop-chart"];
    add_container("chart_types_container", "Choose chart type", $chart_types_list);
}

function get_events(){
    $event_model = new EventModel();
    $event_model->instantiate_query_with_filters(["*"]);
    if (isset($_REQUEST['states_container']) && !in_array('all', $_REQUEST['states_container']))
        $event_model->add_in_filter("state", $_REQUEST['states_container']);

    if (isset($_REQUEST['counties_container']) && !in_array('all', $_REQUEST['counties_container']))
        $event_model->add_in_filter("county", $_REQUEST['counties_container']);

    if (isset($_REQUEST['cities_container']) && !in_array('all', $_REQUEST['cities_container']))
        $event_model->add_in_filter("city", $_REQUEST['cities_container']);

    if (isset($_REQUEST['sides_container']) && !in_array('all', $_REQUEST['sides_container']))
        $event_model->add_in_filter("side", $_REQUEST['sides_container']);

    if (isset($_REQUEST['severities_container']) && !in_array('all', $_REQUEST['severities_container']))
        $event_model->add_in_filter("severity", $_REQUEST['severities_container']);

    if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']))
        $event_model->add_between_filter("start_time",
                                        $_REQUEST['start_date'],
                                        $_REQUEST['end_date']);


    return $event_model->execute_query_with_filters();
}

function create_chart($chart_param){
    // aici trebuie creat chartul pe baza la events :D
    //to do de luat coloanele din meniul 2

    $fp = fopen('../RESOURCES/CSV/chart_data.csv', 'w');
    fputcsv($fp, array('Name', 'Value', 'Color'));
    
    $chart_param = 'state'; //o sa trebuiasca scoasa !!!!

    $events = get_events(); //events map
    $csv_manager = []; //pair name(x)-value(y)
    $colors = ['slateblue', 'lightsalmon','lightskyblue', 'lightgreen']; // colors

    foreach($events as $event){
        if (!array_key_exists($event[$chart_param], $csv_manager)) 
            $csv_manager[$event[$chart_param]] = 1;
        else 
            $csv_manager[$event[$chart_param]] += 1;
    }

    $color_index = 0;
    foreach($csv_manager as $value){
        fputcsv($fp, array(key($csv_manager), $csv_manager[key($csv_manager)], $colors[$color_index]));
        $color_index = ($color_index + 1) % 4;
        next($csv_manager);
    }

}

function load_chart_container(){
    
    if(isset($_REQUEST['chart_types_container'])){
        
        if(in_array('Pie-chart', $_REQUEST['chart_types_container']))
        { 
            $chart = new ChartContainer('Pie_chart');
            $chart->show();
        }

        if(in_array('Bar-plot-chart', $_REQUEST['chart_types_container']))
        {
            $chart = new ChartContainer('Bar_plot_chart');
            $chart->show();
        }
        
        if(in_array('Lollipop-chart', $_REQUEST['chart_types_container']))
        {
            $chart = new ChartContainer('Lollipop_chart');
            $chart->show();
        }
    }
}


include("./../View/statistics_view.php");

if (isset($_REQUEST['submit'])){
    $chart_param = ''; // trebuie extras din meniul 2

    create_chart($chart_param);
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}