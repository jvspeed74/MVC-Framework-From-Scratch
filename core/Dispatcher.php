<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Dispatcher.php
 * Description:
 */


class Dispatcher {
    public function dispatch($router): void {
        $request_uri = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($request_uri, PHP_URL_PATH);
        
        $route_handler = $router->match($request_method, $path);
        
        if ($route_handler) {
            [$controllerName, $actionName] = explode('@', $route_handler);
            $controllerClassName = 'controllers\\' . $controllerName;
            $controller = new $controllerClassName();
            $controller->$actionName();
        } else {
            // Handle 404
            echo '404 - Not Found';
        }
    }
}
