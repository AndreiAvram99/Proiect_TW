<?php
include_once("./../../../config.php");
include("../Model/event_model.php");
include("filter_container_controller.php");
include("chart_container_controller.php");

$event_model = new EventModel();

//CONTAINER_TYPE = 0 - DB_CONTAINER + CUSTOM_CONTAINER + TF_CONTAINER
//CONTAINER_TYPE = 1 - SINGLE_OPTION_CONTAINER
//CONTAINER_TYPE = 2 - BT_CONTAINER  


$TF_COLUMNS = ['amenity', 'traffic_calming', 'bump', 
               'roundabout', 'station', 'crossing', 
               'give_way', 'junction', 'no_exit', 
               'traffic_signal', 'turn_loop', 'rail_way', 
               'stop'];

$BT_COLUMNS = ['start_lat', 'start_lng', 'distance',
               'street_nb', 'temperature', 'wind_chill',
               'humidity', 'pressure', 'visibility', 
               'wind_speed', 'precipitation'];

$DB_COLUMNS = [ 'source', 'state', 'county', 
                'city', 'street_name', 'timezone',
                'airport_code', 'wind_direction', 'weather_condition'];

$TF_OPTIONS = ["Yes", "No"];

$NUMERIC_FIELDS = ['start_lat', 'start_lng', 'distance',
                   'temperature', 'wind_chill', 'humidity', 
                   'pressure', 'visibility', 'wind_speed', 
                   'precipitation', 'severity'];


$DMI = 0;
$DMA = 0;

function add_single_container($name, $title, $content_list, $min, $max, $container_type){
   
    $container = new FilterContainer($name, $title, $min, $max, $container_type);

    if($container_type == 0 || $container_type == 1)
        {
            foreach($content_list as $row){
                $container->add_row($row);
            }
        }
    
    if($container_type == 2) 
        {    
            $container->add_row($name);
        }

    $container->show();
}

function load_true_false_containers(){
    foreach($GLOBALS['TF_COLUMNS'] as $item){
        add_single_container( $item.'_container', 'Presence of '.str_replace('_', ' ', $item).':', $GLOBALS['TF_OPTIONS'], $GLOBALS['DMI'], $GLOBALS['DMA'], 0);
    }
}

function load_between_containers(){
    $column = 'start_lat';
    foreach($GLOBALS['BT_COLUMNS'] as $column){
        $item = $GLOBALS['event_model']->get_column_list($column, 'events');
        $min = min($item);
        $max = max($item);

        add_single_container( $column.'_container', 'Choose '.str_replace('_', ' ', $column).' between['.$min.', '.$max.']', $GLOBALS['BT_COLUMNS'], $min, $max, 2);
    }
}


function load_db_containers(){
    foreach($GLOBALS['DB_COLUMNS'] as $item){
        $column_list = $GLOBALS['event_model']->get_column_list($item, 'events');
        add_single_container( $item.'_container', 'Choose '.str_replace('_', ' ', $item).':', $column_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);
    }
}

function load_custom_containers(){
    
    $sides_list = ['L', 'R'];
    add_single_container('side_container', 'Choose side of accident:', $sides_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);

    $severities_list = [ '1', '2', '3', '4', '5' ];
    add_single_container('severity_container', 'Choose severity:', $severities_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);

    $time_of_day = ['Day', 'Night'];
    add_single_container('sunrise_sunset_container', 'Choose sunrise sunset:', $time_of_day, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);
    add_single_container('civil_twilight_container', 'Choose civil twilight:', $time_of_day, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);
    add_single_container('nautical_twilight_container', 'Choose nautical twilight:', $time_of_day, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);
    add_single_container('astronomical_twilight_container', 'Choose astronomical twilight:', $time_of_day, $GLOBALS['DMI'], $GLOBALS['DMA'], 0);

}

function load_charts_containers(){

    $chart_types_list = [ 'Pie-chart', 'Bar-plot-chart', 'Lollipop-chart'];
    add_single_container('chart_type_container', 'Choose chart type', $chart_types_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 1);

    
    $xaxis_list = [ 'source', 'state', 'county', 'city', 'street_name', 'timezone', 'airport_code', 'wind_direction', 'weather_condition', 'side', 'severity', 'sunrise_sunset', 'civil_twilight', 'nautical_twilight', 'astronomical_twilight' ];
    add_single_container("xaxis_container", "Choose x-axis", $xaxis_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 1);


    $yaxis_list = ['Number-of-accidents'];
    foreach ($GLOBALS['NUMERIC_FIELDS'] as $field){
        array_push($yaxis_list, 'Mean-of-'.$field);
    }  
    add_single_container('yaxis_container', 'Choose y-axis', $yaxis_list, $GLOBALS['DMI'], $GLOBALS['DMA'], 1);

}

function create_by_number_of_accidents($xaxis){
    $fp = fopen('../RESOURCES/CSV/chart_data.CSV', 'w');
    fputcsv($fp, array('Name', 'Value', 'Color'));

    $colors = ['slateblue', 'lightsalmon','lightskyblue', 'lightgreen']; // colors
    $color_index = 0;

    $results = $GLOBALS['event_model']->count_events_group_by_column($xaxis, 'events');
    
    foreach($results as $result){
        fputcsv($fp, array($result[$xaxis], $result['count'], $colors[$color_index]));
        $color_index = ($color_index + 1) % 4;
    }
}


function create_by_mean($xaxis, $yaxis){

    $fp = fopen('../RESOURCES/CSV/chart_data.CSV', 'w');
    fputcsv($fp, array('Name', 'Value', 'Color'));    
    $colors = ['slateblue', 'lightsalmon','lightskyblue', 'lightgreen']; // colors
    $color_index = 0;

    $results = $GLOBALS['event_model']->mean_column_group_by_other_column($yaxis, $xaxis, 'events');
    
    foreach($results as $result){
        fputcsv($fp, array($result[$xaxis], $result['mean'], $colors[$color_index]));
        $color_index = ($color_index + 1) % 4;
    }
}

function create_chart($chart_params){
    $xaxis = $chart_params[0];
    $yaxis = $chart_params[1];

    if($yaxis == "Number-of-accidents")
        create_by_number_of_accidents($xaxis);
    else 
        create_by_mean($xaxis, str_replace('Mean-of-', '', $yaxis));

}

function load_chart_container(){

    if(isset($_REQUEST['chart_type_container']) && sizeof($GLOBALS['events'])!=0 ){
        
        if(in_array('Pie-chart', $_REQUEST['chart_type_container']))
        { 
            $chart = new ChartContainer('Pie_chart');
            $chart->show();
        }

        if(in_array('Bar-plot-chart', $_REQUEST['chart_type_container']))
        {
            $chart = new ChartContainer('Bar_plot_chart');
            $chart->show();
        }
        
        if(in_array('Lollipop-chart', $_REQUEST['chart_type_container']))
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