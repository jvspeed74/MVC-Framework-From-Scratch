<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: config.php
 * Description: Set error reporting, development modes, and base url of the application.
 */

const CI_MODE = "development";

try {
    switch (CI_MODE) {
        case "development":
            // Set up error reporting for development
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('log_errors', 1);
            ini_set('error_log', __DIR__ . "/error.log");
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            break;
        case "production":
            // Set up error reporting for production
            error_reporting(0);
            ini_set('display_errors', 0);
            mysqli_report(MYSQLI_REPORT_OFF);
            break;
        default:
            throw new Exception("CI_MODE not defined");
    }
} catch (Exception $e) {
    ExceptionHandler::handleException($e);
}


// Base URL
const BASE_URL = "/I211-Team-Project/public/index.php";

// Set the default time zone to East Coast
date_default_timezone_set('America/New_York');
