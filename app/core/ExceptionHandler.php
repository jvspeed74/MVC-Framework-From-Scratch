<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Author: Jalen Vaughn
 * Date: 4/14/2024
 * File: ExceptionHandler.php
 * Description: Handles all exceptions in the application.
 */
class ExceptionHandler {
    #[NoReturn]
    static public function handleException(Exception $exception): void {
        self::handleError($exception, "An unexpected error occurred while processing your request.");
    }
    
    #[NoReturn]
    static public function handleConnectionFailure(mysqli_sql_exception $exception): void {
        self::handleError($exception, "Unable to establish connection to our services. Please try again later.");
    }
    
    #[NoReturn]
    static private function handleError($exception, $errorMessage): void {
        // Log the exception
        self::logError($exception->getMessage());
        
        // Generate user-friendly message
        if (CI_MODE == "development") {
            // Optionally, include more details in the error message
            $errorMessage .= " Details: {$exception->getMessage()}";
        }
        
        // Redirect to error page or display a flash message
        ErrorView::render($errorMessage);
        
        // Terminate the application
        die();
    }
    
    static private function logError(string $errorMessage): void {
        error_log('[' . date('Y-m-d H:i:s') . '] ' . $errorMessage);
    }
}
