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
     * Register a route for GET requests.
     *
     * @param string $uri The URI pattern to match.
     * @param string $controllerMethod The controller method to call when the route matches.
     * @return void
     */
    public function get(string $uri, string $controllerMethod): void {
        $this->routes['GET'][$uri] = $controllerMethod;
    }
    
    /**
     * Register a route for POST requests.
     *
     * @param string $uri The URI pattern to match.
     * @param string $controllerMethod The controller method to call when the route matches.
     * @return void
     */
    public function post(string $uri, string $controllerMethod): void {
        $this->routes['POST'][$uri] = $controllerMethod;
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
     * @return array|null An array containing the controller method and captured
     * segments from the URI, or null if no route matches the URI.
     */
    public function lookupRoute(string $uri, string $requestType): ?array {
        foreach ($this->routes[$requestType] as $route => $controllerMethod) {
            // Essentially searches for arguments passed through curly brackets
            $pattern = preg_replace('/\/{(\w+)}/', '/([^/]+)', $route);
            $pattern = '~^' . str_replace('/', '\/', $pattern) . '$~';
            
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                return [$controllerMethod, $matches];
            }
        }
        
        return null;
    }
}

