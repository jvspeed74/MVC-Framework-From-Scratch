<?php

/**
 * Abstract class Controller
 *
 * Base class for controllers responsible for handling requests and coordinating with models and views.
 */
abstract class Controller {
    /**
     * @var object The model instance associated with the controller.
     */
    protected object $model;
    
    /**
     * Constructor.
     * Upon creation of the controller, the loadModel method is called
     * to set the model property to an instance of the object the controller is responsible for.
     */
    public function __construct() {
        $this->model = $this->loadModel();
    }
    
    /**
     * Abstract method to be implemented by child classes.
     * This method should instantiate and return the model associated with the controller.
     *
     * @return object The model instance.
     */
    abstract protected function loadModel(): object;
    
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
