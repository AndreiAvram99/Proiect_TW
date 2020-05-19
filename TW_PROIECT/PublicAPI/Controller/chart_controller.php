<?php

$event_model = new EventModel();
$events = $event_model->get_events();

function create_by_number_of_accidents($column){
    $fp = fopen('../RESOURCES/CSV/chart_data.CSV', 'w');
    fputcsv($fp, array('Name', 'Value'));

    $csv_manager = []; //pair name(x)-value(y)

    foreach($GLOBALS['events'] as $event){
        if (!array_key_exists($event[$column], $csv_manager))
            $csv_manager[$event[$column]] = 1;
        else
            $csv_manager[$event[$column]] += 1;
    }

    $counter = 0;
    foreach($csv_manager as $value){
        fputcsv($fp, array(key($csv_manager), $csv_manager[key($csv_manager)]));
        next($csv_manager);
        //de scos
        if($counter == 40) break;
        $counter++;
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