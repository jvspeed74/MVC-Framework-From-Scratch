<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Dispatcher.php
 * Description:
 */

class Dispatcher {
    protected Router $router;
    
    public function __construct(Router $router) {
        $this->router = $router;
    }
    
    public function dispatch(string $uri, string $requestType) {
        $routeInfo = $this->router->lookupRoute($uri, $requestType);
        
        if ($routeInfo === null) {
            // todo soft error handling
            die('No route defined for this URI.');
        }
        
        [$controllerMethod, $args] = $routeInfo;
        [$controller, $method] = explode('@', $controllerMethod);
        
        $controllerInstance = new $controller;
        
        return call_user_func_array([$controllerInstance, $method], $args);
    }
}
