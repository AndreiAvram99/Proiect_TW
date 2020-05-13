<?php
include("./../../../config.php");
include("./../../Common/request.php");
include("./../../Common/router.php");
include("jwt.php");
include("account_manager.php");

$request = new Request();
$router = new Router();

/**
 * Login request must have username and password in body.
 * If login was successful it returns status:success and a token for the current session.
 */
$router->add_route("POST", "login", "AccountManager::login");

/**
 * Register request must have username, password and register token in body.
 */
$router->add_route("POST", "register", "AccountManager::register");


echo $router->route($request);
