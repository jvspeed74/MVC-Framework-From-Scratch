<?php
namespace PhpWebFramework\core;
/**
 * Class Dispatcher
 *
 * Handles dispatching requests to the appropriate controller method.
 */
class Dispatcher
{
    /**
     * @var Router The router instance to use for dispatching requests.
     */
    protected Router $router;
    
    /**
     * Dispatcher constructor.
     *
     * @param Router $router The router instance to use for dispatching requests.
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }
    
    /**
     * Dispatches the request to the appropriate controller method.
     *
     *  This method uses the provided router to look up the route matching the given URI
     *  and request type. If a matching route is found, it instantiates the corresponding
     *  controller and calls the appropriate method with any captured segments from the URI.
     *
     * @param string $uri The URI of the request.
     * @param string $requestType The type of HTTP request (e.g., GET, POST).
     * @return mixed The result of the controller method execution.
     * @throws PageNotFoundException If a request is unable to be dispatched.
     */
    public function dispatch(string $uri, string $requestType): mixed
    {
        // Check if the request is for a static file
        if ($this->isStaticFileRequest($uri)) {
            // Serve the static file
            $this->serveStaticFile($uri);
            // Return null to indicate that the request has been handled
            return null;
        }
        
        // Proceed with routing for other requests
        $routeInfo = $this->router->lookupRoute($uri, $requestType);
        
        // Handle cases where the URI is not defined
        if ($routeInfo === false) {
            throw new PageNotFoundException();
        }
        
        // Handle cases where the route is a static file
        if ($routeInfo === null) {
            return null;
        }
        
        // Extract controller method and arguments from the routeInfo array
        [$controllerMethod, $args] = $routeInfo;
        
        // Split the controller method into controller and method name
        [$controller, $method] = explode('@', $controllerMethod);
        
        // Create an instance of the controller
        $controllerInstance = new $controller;
        
        // Call the controller method with arguments and return the result
        return call_user_func_array([$controllerInstance, $method], $args);
    }
    
    /**
     * Checks if the request is for a static file.
     *
     * @param string $uri The URI of the request.
     * @return bool True if the request is for a static file, false otherwise.
     */
    private function isStaticFileRequest(string $uri): bool
    {
        // Check if the URI ends with common file extensions for static files
        return preg_match('/\.(css|js|jpg|jpeg|png|gif|ico)$/', $uri);
    }
    
    /**
     * Serves the requested static file.
     *
     * @param string $uri The URI of the static file.
     * @return void
     * @throws PageNotFoundException If file is unable to be found.
     */
    private function serveStaticFile(string $uri): void
    {
        // Serve the static file directly
        $filePath = $_SERVER['DOCUMENT_ROOT'] . $uri;
        if (file_exists($filePath)) {
            // Output appropriate headers
            header("Content-Type: " . mime_content_type($filePath));
            // Output the file contents
            readfile($filePath);
        } else {
            // Handle file not found error
            throw new PageNotFoundException();
        }
    }
}
