<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Router.php
 * Description: Responsible for storing route information containing the controller and method responsible for each
 * route.
 */
class Router {
    protected array $routes = [];
    
    /**
     * Register a route for requests.
     *
     * @param string $requestType GET|POST method
     * @param string $uri The URI pattern to match.
     * @param string $controllerMethod The controller method to call when the route matches.
     * @return void
     */
    public function registerRoute(string $requestType, string $uri, string $controllerMethod): void {
        $this->routes[$requestType][BASE_URL . $uri] = $controllerMethod;
    }
    
    /**
     * Looks up the route matching the given URI and request type.
     *
     * This method iterates over registered routes for the specified request type
     * and attempts to match the provided URI against each route pattern.
     * If a match is found, the corresponding controller method and any captured
     * segments from the URI are returned as an array.
     *
     * @param string $uri The URI to match against registered routes.
     * @param string $requestType The type of HTTP request (e.g., GET, POST).
     * @return array|bool|null An array containing the controller method and captured
     * segments from the URI, or null if no route matches the URI.
     */
    public function lookupRoute(string $uri, string $requestType): null|array|bool {
        // Check if the request is for a static file (e.g., CSS, JS, images)
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico)$/', $uri)) {
            // Return null to indicate that the request should not be routed
            return null;
        }
        
        // Proceed with routing for other requests
        foreach ($this->routes[$requestType] as $route => $controllerMethod) {
            // Essentially searches for arguments passed through curly brackets
            $pattern = preg_replace('/\/{(\w+)}/', '/([^/]+)', $route);
            $pattern = '~^' . str_replace('/', '\/', $pattern) . '$~';
            
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                return [$controllerMethod, $matches];
            }
        }
        return false;
    }
    
}

