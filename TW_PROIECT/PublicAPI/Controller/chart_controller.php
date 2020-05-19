<?php

$event_model = new EventModel();
$events = $event_model->get_events();

function create_by_number_of_accidents($column){
    $fp = fopen('../RESOURCES/CSV/chart_data.CSV', 'w');
    fputcsv($fp, array('Name', 'Value'));

    $results = $GLOBALS['event_model']->count_events_group_by_column($column, 'events');

    foreach($results as $result){
        fputcsv($fp, array($result[$column], $result['count']));
    }

}

function create_by_mean($column, $mean_column){

    $fp = fopen('../RESOURCES/CSV/chart_data.CSV', 'w');
    fputcsv($fp, array('Name', 'Value'));

    $results = $GLOBALS['event_model']->mean_column_group_by_other_column($mean_column, $column, 'events');

    foreach($results as $result){
        fputcsv($fp, array($result[$column], $result['mean']));
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