<?php

/**
 * Abstract class Controller
 *
 * Base class for controllers responsible for handling requests and coordinating with models and views.
 */
abstract class Controller {
    /**
     * @var object|null The model instance associated with the controller.
     */
    protected ?object $model=null;
    protected ?SessionManager $session=null;
    
    /**
     * Renders an error page with an optional message.
     *
     * @param string $message The message to be displayed to the client.
     * @return void
     */
    public function error(string $message): void {
        // Default error page
        ErrorView::render($message);
    }
}
