<?php

include("event_controller.php");
function create_event(){
    $event = new eventController("titlu", "autor", "ceva descriere");

    $event->show();
}

include("ranking_controller.php");
function get_ranking(){
//    to do: trimite ca parametru valorile necesare pentru ranking
    $ranking = new Ranking();

    $ranking->show();
}

include("./../View/index_view.php");
