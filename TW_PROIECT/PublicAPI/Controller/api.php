<?php
include("./../../Common/request.php");
include("./../../Common/router.php");
include("./events.php");

$request = new Request();
$router = new Router();

$router->add_route("GET", "events/{column}", "Events::get_column");

echo $router->route($request);

$a = array('a');
$b = &$a;
$b = array('c');