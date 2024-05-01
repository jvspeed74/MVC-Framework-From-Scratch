<?php
/**
 * File: init.php
 *
 * Description: Initializes the required files and code needed to run the index page.
 * The purpose of this file is to be a hub so the index.php isn't cluttered with code.
 */

// Include Composer autoload file
require_once "../vendor/autoload.php";

// Include configuration file
require_once "config.php";

// Include routes file
require_once "routes.php";

/**
 * Router object located in routes.php
 * Contains route data for the application.
 *
 * @var $router
 */
// Send routes to dispatcher and dispatch the server request.
$dispatcher = new Dispatcher($router);
try {
    $dispatcher->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
} catch (PageNotFoundException $e) {
    // Handle PageNotFoundException
    ExceptionHandler::handleException($e, "Page Not Found: Oops! Looks like the page you requested doesn't exist!");
}
