<?php
/**
 * File: init.php
 * Created By: Jalen Vaughn
 * Date: 4/14/2024
 * Description: Initializes the required files and code needed to run the index page.
 * The purpose of this file is to be a hub so the index.php isn't cluttered with code.
 */

require_once "../vendor/autoload.php";
require_once "config.php";
require_once "routes.php";

/**
 * @var $router
 *
 * Router object located in routes.php
 * Contains route data for the application.
 */
// Send routes to dispatcher and dispatch the server request.
$dispatcher = new Dispatcher($router);
$dispatcher->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
