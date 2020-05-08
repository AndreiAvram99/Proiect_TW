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
    
    $event_model->instantiate_query_with_filters(["*"]);

    if (isset($_REQUEST['sources_container']) && !in_array('All', $_REQUEST['sources_container']))
        $event_model->add_in_filter("source", $_REQUEST['sources_container']);

    if (isset($_REQUEST['states_container']) && !in_array('All', $_REQUEST['states_container']))
        $event_model->add_in_filter("state", $_REQUEST['states_container']);

    if (isset($_REQUEST['counties_container']) && !in_array('All', $_REQUEST['counties_container']))
        $event_model->add_in_filter("county", $_REQUEST['counties_container']);

    if (isset($_REQUEST['cities_container']) && !in_array('All', $_REQUEST['cities_container']))
        $event_model->add_in_filter("city", $_REQUEST['cities_container']);

    if (isset($_REQUEST['streets_name_container']) && !in_array('All', $_REQUEST['streets_name_container']))
        $event_model->add_in_filter("street_name", $_REQUEST['streets_name_container']);
    
    if (isset($_REQUEST['timezones_container']) && !in_array('All', $_REQUEST['timezones_container']))
        $event_model->add_in_filter("timezone", $_REQUEST['timezones_container']);

    if (isset($_REQUEST['airports_code_container']) && !in_array('All', $_REQUEST['airports_code_container']))
        $event_model->add_in_filter("airport_code", $_REQUEST['airports_code_container']);
    
    if (isset($_REQUEST['wind_directions_container']) && !in_array('All', $_REQUEST['wind_directions_container']))
        $event_model->add_in_filter("wind_direction", $_REQUEST['wind_directions_container']);

    if (isset($_REQUEST['weather_condition_container']) && !in_array('All', $_REQUEST['weather_condition_container']))
        $event_model->add_in_filter("weather_condition", $_REQUEST['weather_condition_container']);
    
    if (isset($_REQUEST['sunrise_sunset_container']) && !in_array('All', $_REQUEST['sunrise_sunset_container']))
        $event_model->add_in_filter("sunrise_sunset", $_REQUEST['sunrise_sunset_container']);
    
    if (isset($_REQUEST['civil_twilight_container']) && !in_array('All', $_REQUEST['civil_twilight_container']))
        $event_model->add_in_filter("civil_twilight", $_REQUEST['civil_twilight_container']);
    
    if (isset($_REQUEST['nautical_twilight_container']) && !in_array('All', $_REQUEST['nautical_twilight_container']))
        $event_model->add_in_filter("nautical_twilight", $_REQUEST['nautical_twilight_container']);

    if (isset($_REQUEST['astronomical_twilight_container']) && !in_array('All', $_REQUEST['astronomical_twilight_container']))
        $event_model->add_in_filter("astronomical_twilight", $_REQUEST['astronomical_twilight_container']);

    if (isset($_REQUEST['sides_container']) && !in_array('All', $_REQUEST['sides_container']))
        $event_model->add_in_filter("side", $_REQUEST['sides_container']);

    if (isset($_REQUEST['severities_container']) && !in_array('All', $_REQUEST['severities_container']))
        $event_model->add_in_filter("severity", $_REQUEST['severities_container']);




    if (isset($_REQUEST['amenity_container']) && !in_array('All', $_REQUEST['amenity_container']))
        $event_model->add_in_filter("amenity", $_REQUEST['amenity_container']);

    if (isset($_REQUEST['traffic_calming_container']) && !in_array('All', $_REQUEST['traffic_calming_container']))
        $event_model->add_in_filter("traffic_calming", $_REQUEST['traffic_calming_container']);

    if (isset($_REQUEST['bump_container']) && !in_array('All', $_REQUEST['bump_container']))
        $event_model->add_in_filter("bump", $_REQUEST['bump_container']);

    if (isset($_REQUEST['roundabout_container']) && !in_array('All', $_REQUEST['roundabout_container']))
        $event_model->add_in_filter("roundabout", $_REQUEST['roundabout_container']);

    if (isset($_REQUEST['station_container']) && !in_array('All', $_REQUEST['station_container']))
        $event_model->add_in_filter("staion", $_REQUEST['station_container']);
    
    if (isset($_REQUEST['crossing_container']) && !in_array('All', $_REQUEST['crossing_container']))
        $event_model->add_in_filter("crossing", $_REQUEST['crossing_container']);

    if (isset($_REQUEST['give_way_container']) && !in_array('All', $_REQUEST['give_way_container']))
        $event_model->add_in_filter("give_way", $_REQUEST['give_way_container']);
    
    if (isset($_REQUEST['junction_container']) && !in_array('All', $_REQUEST['junction_container']))
        $event_model->add_in_filter("junction", $_REQUEST['junction_container']);

    if (isset($_REQUEST['no_exit_container']) && !in_array('All', $_REQUEST['no_exit_container']))
        $event_model->add_in_filter("no_exit", $_REQUEST['no_exit_container']);
    
    if (isset($_REQUEST['traffic_signal_container']) && !in_array('All', $_REQUEST['traffic_signal_container']))
        $event_model->add_in_filter("traffic_signal", $_REQUEST['traffic_signal_container']);
    
    if (isset($_REQUEST['turn_loop_container']) && !in_array('All', $_REQUEST['turn_loop_container']))
        $event_model->add_in_filter("turn_loop", $_REQUEST['turn_loop_container']);
    
    if (isset($_REQUEST['rail_way_container']) && !in_array('All', $_REQUEST['rail_way_container']))
        $event_model->add_in_filter("rail_way", $_REQUEST['rail_way_container']);

    if (isset($_REQUEST['stop_container']) && !in_array('All', $_REQUEST['stop_container']))
        $event_model->add_in_filter("stop", $_REQUEST['stop_container']);


    if (isset($_REQUEST['latitude_min']) && isset($_REQUEST['latitude_max']))
        $event_model->add_between_filter("start_lat",
                                        $_REQUEST['latitude_min'],
                                        $_REQUEST['latitude_max']);

    if (isset($_REQUEST['longitude_min']) && isset($_REQUEST['longitude_max']))
        $event_model->add_between_filter("start_lng",
                                        $_REQUEST['longitude_min'],
                                        $_REQUEST['longitude_max']);

    if (isset($_REQUEST['distance_min']) && isset($_REQUEST['end_date_max']))
        $event_model->add_between_filter("distance",
                                        $_REQUEST['distance_min'],
                                        $_REQUEST['end_date_max']);

    if (isset($_REQUEST['street_nb_min']) && isset($_REQUEST['street_nb_max']))
        $event_model->add_between_filter("street_nb",
                                        $_REQUEST['street_nb_min'],
                                        $_REQUEST['street_nb_max']);

    if (isset($_REQUEST['temperature(c)_min']) && isset($_REQUEST['temperature(c)_max']))
        $event_model->add_between_filter("temperature",
                                        $_REQUEST['temperature(c)_min'],
                                        $_REQUEST['temperature(c)_max']);

    if (isset($_REQUEST['wind_chill_min']) && isset($_REQUEST['wind_chill_max']))
        $event_model->add_between_filter("wind_chill",
                                        $_REQUEST['wind_chill_min'],
                                        $_REQUEST['wind_chill_max']);

    if (isset($_REQUEST['humidity_min']) && isset($_REQUEST['humidity_max']))
        $event_model->add_between_filter("humidity",
                                        $_REQUEST['humidity_min'],
                                        $_REQUEST['humidity_max']);


    if (isset($_REQUEST['pressure_min']) && isset($_REQUEST['pressure_max']))
        $event_model->add_between_filter("pressure",
                                        $_REQUEST['pressure_min'],
                                        $_REQUEST['pressure_max']);

    if (isset($_REQUEST['visibility_min']) && isset($_REQUEST['visibility_max']))
        $event_model->add_between_filter("visibility",
                                        $_REQUEST['visibility_min'],
                                        $_REQUEST['visibility_max']);

    if (isset($_REQUEST['wind_speed_min']) && isset($_REQUEST['wind_speed_max']))
        $event_model->add_between_filter("wind_speed",
                                        $_REQUEST['wind_speed_min'],
                                        $_REQUEST['wind_speed_max']);

    if (isset($_REQUEST['precipitation_min']) && isset($_REQUEST['precipitation_max']))
        $event_model->add_between_filter("precipitation",
                                        $_REQUEST['precipitation_min'],
                                        $_REQUEST['precipitation_max']);




    if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']))
        $event_model->add_between_filter("start_time",
                                        $_REQUEST['start_date'],
                                        $_REQUEST['end_date']);

    return $event_model->execute_query_with_filters();
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
    debug_to_console($yaxis);
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
        debug_to_console($_REQUEST['xaxis_container'][0]);
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