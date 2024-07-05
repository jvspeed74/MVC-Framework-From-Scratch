<?php

namespace PhpWebFramework\controllers;

use PhpWebFramework\views\error\ErrorView;

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
     * @param string $message
     * @return void
     */
    public function display(string $message = ''): void
    {
        
        // Display appropriate error message
        if (!$message) {
            $message = 'An unknown error occurred while conducting site operations.';
        }
        
        // Render the error page
        ErrorView::render($message);
    }
}
