<?php

/*
File: Controller.php
Created By: Jalen Vaughn
Date: 4/9/2024
Description: 
*/

abstract class Controller {
    protected object $model;
    
    public function __construct() {
        $this->model = $this->loadModel();
    }
    abstract protected function loadModel(): object;
    
    public function error(string $message='An error occurred.'): void {
        ErrorView::render($message);
    }
    
}
