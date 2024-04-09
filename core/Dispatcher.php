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
        $controllerMethod = $this->router->lookupRoute($uri, $requestType);
        
        if ($controllerMethod === null) {
            // todo soft error handling
            die('No route defined for this URI.');
        }
        
        [$controller, $method] = explode('@', $controllerMethod);
        
        $controllerInstance = new $controller;
        
        return $controllerInstance->$method();
    }
}
