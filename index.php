<?php
/*
File: index.php
Created By: diffi
Date: 4/4/2024
Description: 
*/



require_once "vendor/autoload.php";
require_once "core/config.php";

$router = new Router();
$router->get(BASE_URL . "/index.php", 'ProductController@index');
$router->get(BASE_URL . "/index.php/product/show", 'ProductController@show');

$dispatcher = new Dispatcher($router);
$dispatcher->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


