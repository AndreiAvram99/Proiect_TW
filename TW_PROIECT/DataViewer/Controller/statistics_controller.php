<?php
include("../Model/event_model.php");
include("filter_container_controller.php");
include("chart_container_controller.php");

$event_model = new EventModel();
$events = get_events();

function add_container($name, $title, $content_list){
   
    $container = new FilterContainer($name, $title, 0);

    foreach($content_list as $row){
        $container->add_row($row);
    }

    $container->show();

} 

function add_single_opiton_container($name, $title, $content_list){

    $container = new FilterContainer($name, $title, 1);

    foreach($content_list as $row){
        $container->add_row($row);
    }

    $container->show();
}

function add_between_container($name, $title){
    
    $container = new FilterContainer($name, $title, 2);
    $container->add_row($name);
    $container->show();
}


function load_true_false_container($name){
    $items_list = ["Yes", "No"];
    add_container(strtolower($name)."_container", "Presence of: ".$name, $items_list);
}

function load_container($table, $column, $container_id, $container_name){
    $column_list = $GLOBALS['event_model']->get_column_list($column, $table);
    add_container($container_id, $container_name, $column_list);
}

function load_between_container($name){
    add_between_container(strtolower($name), $name);
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
    add_single_opiton_container("chart_types_container", "Choose chart type", $chart_types_list);
}

function load_xaxis_container(){
    $xaxis_list = [ "State", "County", "City", "Side", "Severity", "Source", "Street_name", "Timezone", "Airport_code", "Wind_direction", "Weather_condition", "Sunrise_sunset", "Civil_twilight", "Nautical_twilight", "Astronomical_twilight"];
    add_single_opiton_container("xaxis_container", "Choose x-axis", $xaxis_list);
}

function load_yaxis_container(){
    $yaxis_list = [ "Number-of-accidents", "Mean-of-severity", "Mean-of-distance" ];
    add_single_opiton_container("yaxis_container", "Choose y-axis", $yaxis_list);
}

function get_events(){
    $event_model = new EventModel();

    return $event_model->get_events();
}


function create_by_noa($xaxis){

    $fp = fopen('../RESOURCES/CSV/chart_data.csv', 'w');
    fputcsv($fp, array('Name', 'Value', 'Color'));
    
    $csv_manager = []; //pair name(x)-value(y)
    $colors = ['slateblue', 'lightsalmon','lightskyblue', 'lightgreen']; // colors


    foreach($GLOBALS['events'] as $event){
        if (!array_key_exists($event[$xaxis], $csv_manager)) 
            $csv_manager[$event[$xaxis]] = 1;
        else 
            $csv_manager[$event[$xaxis]] += 1;
    }

    $color_index = 0;
    foreach($csv_manager as $value){
        fputcsv($fp, array(key($csv_manager), $csv_manager[key($csv_manager)], $colors[$color_index]));
        $color_index = ($color_index + 1) % 4;
        next($csv_manager);
    }

}

function create_chart($chart_params){
    // aici trebuie creat chartul pe baza la events :D
    $xaxis = $chart_params[0];
    $yaxis = $chart_params[1];
    if($yaxis == "Number-of-accidents")
        create_by_noa($xaxis);

}

function load_chart_container(){
    if(isset($_REQUEST['chart_types_container']) && sizeof($GLOBALS['events'])!=0 ){
        
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
    else 
        echo "<p style='font-size:35px; text-align: center; margin-bottom: 90px;'> We can't find any result !!</p>"; 
}


include("./../View/statistics_view.php");

function get_chart_params(){
    $params = array();

    if (isset($_REQUEST['xaxis_container']) && isset($_REQUEST['yaxis_container'])){
        array_push($params, strtolower($_REQUEST['xaxis_container'][0]));
        array_push($params, $_REQUEST['yaxis_container'][0]);
        return $params;
    }
}

if (isset($_REQUEST['submit'])){
    $chart_params = get_chart_params();
    create_chart($chart_params);
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}