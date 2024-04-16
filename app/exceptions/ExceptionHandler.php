<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Author: Jalen Vaughn
 * Date: 4/15/2024
 * File: ExceptionHandler.php
 * Description:
 */
class ExceptionHandler {
    #[NoReturn]
    static public function handleException(exception $exceptionObj, string $userMessage = "An unexpected error occurred while processing your request."): void {
        // Get exception details
        $exceptionDetails = self::getExceptionDetails($exceptionObj);
        
        // Log exception details
        self::logException($exceptionDetails);
        
        // Display error page
        self::renderErrorPage($userMessage);
        
        // Terminate the application
        die();
    }
    
    static protected function logException(array $exceptionDetails): void {
        $logMessage = '';
        foreach ($exceptionDetails as $key => $value) {
            $logMessage .= $key . ': ' . $value . PHP_EOL;
        }
        error_log($logMessage);
    }
    
    static protected function renderErrorPage(string $message): void {
        ErrorView::render($message);
    }
    
    static protected function getExceptionDetails(exception $exceptionObj): array {
        return [
            'message' => $exceptionObj->getMessage(),
            'code' => $exceptionObj->getCode(),
            'file' => $exceptionObj->getFile(),
            'line' => $exceptionObj->getLine(),
            'trace' => $exceptionObj->getTraceAsString()
        ];
    }
}
