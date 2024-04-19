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
        $routeInfo = $this->router->lookupRoute($uri, $requestType);
        
        if ($routeInfo === null) {
            // todo soft error handling
            die('No route defined for this URI.');
        }
        
        [$controllerMethod, $args] = $routeInfo;
        [$controller, $method] = explode('@', $controllerMethod);
        
        $controllerInstance = new $controller;
        
        //todo handle error if false
        return call_user_func_array([$controllerInstance, $method], $args);
    }
}
