<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Router.php
 * Description:
 */

class Router {
    protected array $routes = [];
    
    public function get(string $uri, string $controllerMethod): void {
        $this->routes['GET'][$uri] = $controllerMethod;
    }
    
    public function post(string $uri, string $controllerMethod): void {
        $this->routes['POST'][$uri] = $controllerMethod;
    }
    
    public function lookupRoute(string $uri, string $requestType): ?string {
        if (isset($this->routes[$requestType][$uri])) {
            return $this->routes[$requestType][$uri];
        }
        
        return null;
    }
}
