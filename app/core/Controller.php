<?php
/**
 * File: Controller.php
 * Created By: Jalen Vaughn
 * Date: 4/9/2024
 * Description: Creates an abstract class Controller that contains the base functionality of each inherited controller.
 */
abstract class Controller {
    protected object $model;
    
    /**
     * Upon creation of the controller, the loadModel method is called and sets the model property to an instance of the
     * object the controller is responsible for.
     */
    public function __construct() {
        $this->model = $this->loadModel();
    }
    
    /**
     * Calls the getInstance method from the model.
     *
     * @return object
     */
    abstract protected function loadModel(): object;
    
    /**
     * Renders an error pages with an optional message.
     *
     * @param string $message The message to be displayed to the client
     * @return void
     */
    public function error(string $message): void {
        //todo expand error functionality
        ErrorView::render($message);
    }
    
}
