<?php

include("event.php");
function create_event(){
    $event = new Event("titlu", "autor", "ceva descriere");

    $event->show();
}

include("ranking.php");
function get_ranking(){
//    to do: trimite ca parametru valorile necesare pentru ranking
    $ranking = new Ranking();

    $ranking->show();
}

include("./../View/index.php");
