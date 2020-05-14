<?php
include_once("./../../../config.php");
include_once("./../../Common/request.php");
include_once("./../../Common/router.php");
include("jwt.php");
include("account_manager.php");

$request = new Request();
$router = new Router();

/**
 * Login request must have username and password in body.
 * If login was successful it returns status:success and a token for the current session.
 */
$router->add_route("POST", "v1/login", "AccountManager::login");

/**
 * Register request must have username, password and register token in body.
 */
$router->add_route("POST", "v1/register", "AccountManager::register");


$router->add_route("POST", "v1/events", "AccountManager::create_event");

echo $router->route($request);
