<?php
/**
 * File: routes.php
 *
 * Description: Contains route declarations for each page.
 */

namespace PhpWebFramework\core;

// Initialize Router object
$router = new Router();

/**
 * Home page:
 * - index: Displays a static welcome page
 */
$router->registerRoute('GET', "", 'HomeController@index');


/**
 * Product page:
 * - index: Lists all products.
 * - show: Displays details of a single product.
 * - search: Displays the products found in the user search result.
 * - create: Creates a new product based on form submission.
 */
$router->registerRoute("GET", "/product/index", 'ProductController@index');
$router->registerRoute("GET", "/product/show/{id}", 'ProductController@show');
$router->registerRoute("GET", "/product/search/{terms}", 'ProductController@search');
$router->registerRoute("GET", "/product/create", 'ProductController@create');
$router->registerRoute("POST", "/product/create", 'ProductController@create');

/**
 * Courses page:
 * - index: Displays a calendar of all courses.
 * - fetch: Fetches courses based on a specific date.
 */
$router->registerRoute("GET", "/course/index", "CourseController@index");
$router->registerRoute("GET", "/course/fetch", "CourseController@fetch");
$router->registerRoute("GET", "/course/fetch/{date}", "CourseController@fetch");

/**
 * User page:
 * - login: Handles user login.
 * - signup: Handles user signup.
 * - logout: Handles user logout.
 */
$router->registerRoute("GET", "/user/login", "UserController@login");
$router->registerRoute("GET", "/user/login/{message}", "UserController@login");
$router->registerRoute("GET", "/user/signup", "UserController@signup");
$router->registerRoute('GET', '/user/logout', 'UserController@logout');

$router->registerRoute("POST", "/user/login", "UserController@login");
$router->registerRoute("POST", "/user/signup", "UserController@signup");

/**
 * Shopping Cart Page:
 * - index: Lists all items in the cart.
 * - add: Adds a product to the cart.
 * - remove: Removes a product from the cart.
 * - update: Updates the quantities of products in the cart.
 */
$router->registerRoute("GET", "/cart/index", 'CartController@index');
$router->registerRoute("GET", "/cart/index/{message}", 'CartController@index');
$router->registerRoute("GET", "/cart/add/{id}", 'CartController@add');
$router->registerRoute("GET", "/cart/remove/{id}", 'CartController@remove');
$router->registerRoute("GET", "/cart/checkout", 'CartController@checkout');

$router->registerRoute("POST", "/cart/update", 'CartController@update');

/**
 * Error Page:
 * - Displays the error page
 */
$router->registerRoute("GET", "/error/display/{message}", "ErrorController@display");
