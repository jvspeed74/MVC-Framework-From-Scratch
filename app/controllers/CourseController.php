<?php

/**
 * Class CourseController
 *
 * Controller responsible for managing courses.
 */
class CourseController extends Controller {
    
    /**
     * CourseController constructor.
     *
     * Initializes the controller.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Loads the CourseModel.
     *
     * @return object The CourseModel instance.
     */
    protected function loadModel(): object {
        // Load CourseModel instance
        return CourseModel::getInstance();
    }
    
    /**
     * Renders the index view for courses.
     */
    public function index(): void {
        // Render index view
        CourseIndexView::render();
    }
    
    /**
     * Fetches courses by date.
     *
     * Expects 'date' parameter in the GET request.
     * Retrieves courses for the specified date from the model,
     * encodes them as JSON, and sends the response to the client.
     */
    public function fetch(): void {
        // Retrieve date parameter from GET request
        $date = $_GET['date'];
        
        // Fetch courses for the specified date
        $courses = $this->model->fetchByDate($date);
        
        // Encode courses array as JSON
        $jsonResponse = json_encode($courses);
        
        // Set response headers to indicate JSON content
        header('Content-Type: application/json');
        
        // Send the JSON response back to the client
        echo $jsonResponse;
    }
}
