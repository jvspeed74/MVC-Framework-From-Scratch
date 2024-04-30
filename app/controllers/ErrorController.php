<?php

//todo document
class ErrorController {
    public function display(string $message=''): void {
        // Display appropriate error message
        if (empty($message)) {
            $message = 'An unknown error occurred while conducting site operations.';
        }
        
        // Render the error page
        ErrorView::render($message);
    }
}
