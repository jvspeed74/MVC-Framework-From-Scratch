<?php
/**
 * File: config.php
 * Description: Set error reporting, development modes, and base URL of the application.
 */

// Set up error reporting and development modes based on CI_MODE constant
const CI_MODE = ""; // Possible values: "development", "production"

switch (CI_MODE) {
    case "development":
        // Set up error reporting for development
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    default:
        // Set up error reporting for production
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        ini_set('display_errors', 0);
}

// Set error handling configuration
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . "/error.log");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Default handler for uncaught exceptions
set_exception_handler(['ExceptionHandler', 'handleException']);

// Base URL for the application
const BASE_URL = "/I211-Team-Project/public/index.php";
// Base URL used for routing within the application

// Set the default time zone to East Coast
date_default_timezone_set('America/New_York'); // Default time zone for the application
