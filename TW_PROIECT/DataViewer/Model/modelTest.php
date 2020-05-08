<?php

include("event_model.php");

$event_model = new EventModel();

echo $event_model->get_number_of_events().'<br>';
$events = $event_model->get_event(0, 10);

foreach ($events as $ev){
    echo $ev["city"].'<br>';
}