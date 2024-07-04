<?php

/**
 * Controller responsible for displaying error messages.
 */
class ErrorController
{
    /**
     * Displays the error message.
     *
     * Retrieves the error message from the GET parameters,
     * and renders the appropriate view based on the message.
     *
     * @return void
     */
    public function display(): void
    {
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
