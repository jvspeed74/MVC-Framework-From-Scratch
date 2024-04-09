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
//$router->get('/', 'ProductController@index');
$router->get('/I211-Team-Project/index.php', 'ProductController@index');

$dispatcher = new Dispatcher($router);
$dispatcher->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);


