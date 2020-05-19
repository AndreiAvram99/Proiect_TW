<?php
include_once("./../../../config.php");
include_once("./../../Common/request.php");
include_once("./../../Common/router.php");
include("events.php");

$request = new Request();
$router = new Router();

/**
 * Return the list of columns as JSON.
 */
$router->add_route("GET", "v1/events/columns", "Events::get_columns_list");

/**
 * Return all distinct elements from specified column as JSON.
 */
$router->add_route("GET", "v1/events/columns/{column}", "Events::get_column");

/**
 * Return filtered events according to certain parameters as JSON.
 */
$router->add_route("GET", "v1/events", "Events::get_events");

/**
 * Return a chart with filtered events.
 */
$router->add_route("GET", "v1/events/statistics", "Events::get_statistics");

echo $router->route($request);