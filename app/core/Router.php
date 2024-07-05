<?php

namespace PhpWebFramework\core;

/**
 * Class Router
 *
 * Handles routing of requests to controller methods based on URI patterns.
 */
class Router
{
    /**
     * @var array The registered routes.
     */
    protected array $routes = [];
    
    /**
     * Register a route for requests.
     *
     * @param string $requestType GET|POST method.
     * @param string $uri The URI pattern to match.
     * @param array $controllerMethod The controller method to call when the route matches.
     * @return void
     */
    public function registerRoute(string $requestType, string $uri, array $controllerMethod): void
    {
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
     * @return array|false|null An array containing the controller method and captured
     * segments from the URI, null if the request shouldn't be routed, or false if no route is found.
     */
    public function lookupRoute(string $uri, string $requestType): null|array|false
    {
        // Check if the request is for a static file
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico)$/', $uri)) {
            // Return null to indicate that the request should not be routed
            return null;
        }
        
        // Proceed with routing for other requests
        foreach ($this->routes[$requestType] as $route => $controllerMethod) {
            // Construct regular expression pattern from route
            $pattern = preg_replace('/\/{(\w+)}/', '/([^/]+)', $route);
            $pattern = '~^' . str_replace('/', '\/', $pattern) . '$~';
            
            // Check if URI matches the pattern
            if (preg_match($pattern, $uri, $matches)) {
                // Remove full match from matches array
                array_shift($matches);
                // Return controller method and captured segments
                $controllerMethod[] = $matches;
                return $controllerMethod;
            }
        }
        // No route found
        return false;
    }
}
