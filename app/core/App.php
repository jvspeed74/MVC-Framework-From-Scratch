<?php

/*
File: App.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = []; // Parameters to be passed to the method
    
    public function __construct() {
        $url = $this->parseUrl(); // Parse the URL
        
        // Check if the controller exists and is specified in the URL
        if ($url && isset($url[0]) && file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }
        
        // Require the controller file and instantiate the controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;
        
        // Check if the method exists and is specified in the URL
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }
        
        // Set the parameters
        $this->params = $url ? array_values($url) : [];
        
        // Call the controller method with the parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    protected function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return []; // Return an empty array if $_GET['url'] is not set
    }
    
}
