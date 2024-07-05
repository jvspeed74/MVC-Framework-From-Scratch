<?php
/**
 * File: routes.php
 *
 * Description: Contains route declarations for each page.
 */

namespace PhpWebFramework\core;

use PhpWebFramework\controllers\CartController;
use PhpWebFramework\controllers\ErrorController;
use PhpWebFramework\controllers\HomeController;
use PhpWebFramework\controllers\ProductController;
use PhpWebFramework\controllers\UserController;

// Initialize Router object
$router = new Router();

/**
 * Home page:
 * - index: Displays a static welcome page
 */
$router->registerRoute('GET', "", [HomeController::class, 'index']);


/**
 * Product page:
 * - index: Lists all products.
 * - show: Displays details of a single product.
 * - search: Displays the products found in the user search result.
 * - create: Creates a new product based on form submission.
 */
$router->registerRoute("GET", "/product/index", [ProductController::class, 'index']);
$router->registerRoute("GET", "/product/show/{id}", [ProductController::class, 'show']);
$router->registerRoute("GET", "/product/search/{terms}", [ProductController::class, 'search']);
$router->registerRoute("GET", "/product/create", [ProductController::class, 'create']);
$router->registerRoute("POST", "/product/create", [ProductController::class, 'create']);

/**
 * User page:
 * - login: Handles user login.
 * - signup: Handles user signup.
 * - logout: Handles user logout.
 */
$router->registerRoute("GET", "/user/login", [UserController::class, 'login']);
$router->registerRoute("GET", "/user/login/{message}", [UserController::class, 'login']);
$router->registerRoute("GET", "/user/signup", [UserController::class, 'signup']);
$router->registerRoute('GET', '/user/logout', [UserController::class, 'logout']);
$router->registerRoute("POST", "/user/login", [UserController::class, 'login']);
$router->registerRoute("POST", "/user/signup", [UserController::class, 'signup']);

/**
 * Shopping Cart Page:
 * - index: Lists all items in the cart.
 * - add: Adds a product to the cart.
 * - remove: Removes a product from the cart.
 * - update: Updates the quantities of products in the cart.
 */
$router->registerRoute("GET", "/cart/index", [CartController::class, 'index']);
$router->registerRoute("GET", "/cart/index/{message}", [CartController::class, 'index']);
$router->registerRoute("GET", "/cart/add/{id}", [CartController::class, 'add']);
$router->registerRoute("GET", "/cart/remove/{id}", [CartController::class, 'remove']);
$router->registerRoute("GET", "/cart/checkout", [CartController::class, 'checkout']);
$router->registerRoute("POST", "/cart/update", [CartController::class, 'update']);

/**
 * Error Page:
 * - Displays the error page
 */
$router->registerRoute("GET", "/error/display/{message}", [ErrorController::class, 'display']);
