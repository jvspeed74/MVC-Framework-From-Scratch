<?php

use JetBrains\PhpStorm\NoReturn;

/**
 * Class ExceptionHandler
 *
 * Handles exceptions and errors, logs details, and renders error pages.
 */
class ExceptionHandler {
    /**
     * Handles the given exception or error.
     *
     * @param Exception|Error $exception The exception or error to handle.
     * @param string $message The optional message to display to the user.
     *
     * @return void
     */
    #[NoReturn]
    public static function handleException(Exception|Error $exception, string $message = ''): void {
        // Log exception details
        self::logDetails($exception);
        
        // Determine the message to display to the user
        if (empty($message)) {
            $message = "An unknown error occurred while conducting site operations.";
        }
        
        // Render the error page
        ErrorView::render($message);
        
        // Terminate the application gracefully
        exit();
    }
    
    /**
     * Logs details of the given exception or error.
     *
     * @param Exception|Error $exception The exception or error to log.
     *
     * @return void
     */
    protected static function logDetails(Exception|Error $exception): void {
        $exceptionDetails = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ];
        
        // Format and send exception details to the log file
        error_log(implode(PHP_EOL, $exceptionDetails));
    }
}
