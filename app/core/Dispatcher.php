<?php


/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Dispatcher.php
 * Description: Responsible for routing requests to their appropriate controller and method.
 */
class Dispatcher {
    protected Router $router;
    
    /**
     * Dispatcher constructor.
     *
     * @param Router $router The router instance to use for dispatching requests.
     */
    public function __construct(Router $router) {
        $this->router = $router;
    }
    
    /**
     * Dispatches the request to the appropriate controller method.
     *
     * This method uses the provided router to look up the route matching the given URI
     * and request type. If a matching route is found, it instantiates the corresponding
     * controller and calls the appropriate method with any captured segments from the URI.
     *
     * @param string $uri The URI of the request.
     * @param string $requestType The type of HTTP request (e.g., GET, POST).
     * @return mixed The result of the controller method execution.
     */
    public function dispatch(string $uri, string $requestType): mixed {
        // Check if the request is for a static file (e.g., CSS, JS, images)
        if ($this->isStaticFileRequest($uri)) {
            // Serve the static file directly (e.g., by returning the file contents)
            $this->serveStaticFile($uri);
            // Return null to indicate that the request has been handled
            return null;
        }
        
        // Proceed with routing for other requests
        $routeInfo = $this->router->lookupRoute($uri, $requestType);
        
        if ($routeInfo === false) {
            die("URI not defined");
        } elseif ($routeInfo !== null) {
            
            [$controllerMethod, $args] = $routeInfo;
            [$controller, $method] = explode('@', $controllerMethod);
            
            $controllerInstance = new $controller;
            
            return call_user_func_array([$controllerInstance, $method], $args);
        } else {
            return null;
        }
    }
    
    /**
     * Checks if the request is for a static file.
     *
     * @param string $uri The URI of the request.
     * @return bool True if the request is for a static file, false otherwise.
     */
    private function isStaticFileRequest(string $uri): bool {
        // Check if the URI ends with common file extensions for static files (e.g., .css, .js, .jpg)
        return preg_match('/\.(css|js|jpg|jpeg|png|gif|ico)$/', $uri);
    }
    
    /**
     * Serves the requested static file.
     *
     * @param string $uri The URI of the static file.
     * @return void
     */
    private function serveStaticFile(string $uri): void {
        // Serve the static file directly (e.g., by reading and outputting the file contents)
        $filePath = $_SERVER['DOCUMENT_ROOT'] . $uri;
        if (file_exists($filePath)) {
            // Output appropriate headers
            header("Content-Type: " . mime_content_type($filePath));
            // Output the file contents
            readfile($filePath);
        } else {
            // Handle file not found error
            header("HTTP/1.0 404 Not Found");
            echo "File not found";
        }
    }
}
