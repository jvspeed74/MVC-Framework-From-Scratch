<?php

//todo document
class ErrorController {
    public function display(): void {
        // Get message
        $message = $_GET["message"];
        
        // Display appropriate error message
        if (empty($_GET['message'])) {
            $message = 'An unknown error occurred while conducting site operations.';
        }
        
        // Render the error page
        ErrorView::render($message);
    }
}
