<?php
include("./../../../config.php");
include("./../../Common/request.php");
include("./../../Common/router.php");
include("events.php");

$request = new Request();
$router = new Router();

$router->add_route("GET", "/v1/events", "Events::get_events");
$router->add_route("GET", "/v1/events/columns", "Events::get_columns");
$router->add_route("GET", "/v1/events/columns/{column}", "Events::get_column_values");
$router->add_route("GET", "/v1/events/mean", "Events::get_mean_values");

echo $router->route($request);
