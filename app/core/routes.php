<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/9/24
 * File: routes.php
 * Description: Contains route declarations for each page.
 */


// Initialize Router object
$router = new Router();

/**
 * Product page:
 * - index: Lists all products.
 * - show: Displays details of a single product.
 * - search: Displays the products found in the user search result.
 */
$router->registerRoute("GET", "", 'ProductController@index');
$router->registerRoute("GET", "/product/show/{id}", 'ProductController@show');
$router->registerRoute("GET", "/product/search/{terms}", 'ProductController@search');
$router->registerRoute("GET", "/product/create", 'ProductController@create');
$router->registerRoute("POST", "/product/create", 'ProductController@create');

/**
 * Courses page:
 * - index: displays a calendar of all courses
 */
$router->registerRoute("GET", "/course/index", "CourseController@index");
$router->registerRoute("GET", "/course/fetch", "CourseController@fetch");
$router->registerRoute("GET", "/course/fetch/{date}", "CourseController@fetch");
