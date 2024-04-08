<?php
/*
File: index.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

use core\Dispatcher;
use core\Router;

require "vendor/autoload.php";

// Instantiate the Router and Dispatcher
$router = new Router();
$dispatcher = new Dispatcher();

// Add routes
$router->addRoute('GET', '/', 'HomeController@index');

// Dispatch the request
$dispatcher->dispatch($router);
