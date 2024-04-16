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
    public static function handleException(Exception|Error $exception): void {
        $exceptionDetails = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ];
        
        // Parse and send exception details to the log file.
        error_log(implode(PHP_EOL, $exceptionDetails));
        
        // Render the error page.
        ErrorView::render("An unknown error occurred while conducting site operations.");
        
        // Kill the application
        die();
    }
}
