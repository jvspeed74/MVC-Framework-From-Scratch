<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Author: Jalen Vaughn
 * Date: 4/16/2024
 * File: ExceptionHandler.php
 * Description:
 */
class ExceptionHandler {
    #[NoReturn]
    public static function handleException(Exception|Error $exception, $message = ''): void {
        // Send info to error.log
        self::logDetails($exception);
        
        // Get message to display to user
        if (empty($message)) {
            $message = "An unknown error occurred while conducting site operations.";
        }
        
        // Render the error page.
        ErrorView::render($message);
        
        // Kill the application
        die();
    }
    
    protected static function logDetails(Exception|Error $exception): void {
        $exceptionDetails = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ];
        
        // Parse and send exception details to the log file.
        error_log(implode(PHP_EOL, $exceptionDetails));
    }
}
