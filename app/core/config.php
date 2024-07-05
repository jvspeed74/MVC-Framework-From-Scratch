<?php
/**
 * File: config.php
 * Description: Set error reporting, development modes, and base URL of the application.
 */

namespace PhpWebFramework\core;

use PhpWebFramework\exceptions\ExceptionHandler;

// Set up error reporting for production
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . DIRECTORY_SEPARATOR . "error.log");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Default handler for uncaught exceptions
set_exception_handler([ExceptionHandler::class, 'handleException']);

// Constant URLs used for routing within the application
const BASE_URL = "/PHP-Web-Framework/public/index.php";
const IMG_URL = "/PHP-Web-Framework/public";

// Set the default time zone to East Coast
date_default_timezone_set('America/New_York'); // Default time zone for the application
