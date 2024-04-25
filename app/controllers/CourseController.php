<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/20/24
 * File: CourseController.php
 * Description:
 */
class CourseController extends Controller {
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * @inheritDoc
     */
    protected function loadModel(): object {
        return CourseModel::getInstance();
    }
    
    public function index(): void {
        CourseIndexView::render();
    }
    
    public function fetch(): void {
        $date = $_GET['date'];
        
        $courses = $this->model->fetchByDate($date);
        
        $jsonResponse = json_encode($courses);
        
        // Set response headers
        header('Content-Type: application/json');
        
        // Send the JSON response back to the client
        echo $jsonResponse;
    }
}
