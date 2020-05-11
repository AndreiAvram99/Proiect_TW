<?php
include("./../../Common/request.php");
include("./../../Common/router.php");
include("events.php");

$request = new Request();
$router = new Router();

/**
 * Return the list of columns as JSON.
 */
$router->add_route("GET", "events/columns", "Events::get_columns_list");

/**
 * Return all distinct elements from specified column as JSON.
 */
$router->add_route("GET", "events/columns/{column}", "Events::get_column");

echo $router->route($request);