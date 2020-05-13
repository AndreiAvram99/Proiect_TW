<?php
include("./../../../config.php");
include("./../../Common/request.php");
include("./../../Common/router.php");
include("events.php");

$request = new Request();
$router = new Router();

$router->add_route("GET", "/events", "Events::get_events");
$router->add_route("GET", "/events/columns", "Events::get_column_values");

echo $router->route($request);
