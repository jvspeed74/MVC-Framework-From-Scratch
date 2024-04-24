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
$router->get(BASE_URL, 'ProductController@index');
$router->get(BASE_URL . "/product/show/{id}", 'ProductController@show');
$router->get(BASE_URL . "/product/search/{terms}", 'ProductController@search');
$router->get(BASE_URL . "/product/create", 'ProductController@create');
$router->post(BASE_URL . "/product/create", 'ProductController@create');
$router->get(BASE_URL . "/cart", 'ProductController@showCart');
$router->get(BASE_URL . "/cart/add/{id}", 'ProductController@addToCart');
$router->get(BASE_URL . "/cart/remove/{id}", 'ProductController@removeFromCart');
$router->post(BASE_URL . "/cart/update", 'ProductController@updateCart');

