<?php

include("./../Model/event_model.php");

$event = new EventModel();
echo $event->get_events();