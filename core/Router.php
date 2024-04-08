<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Router.php
 * Description:
 */


class Router {
    private $routes = [];
    
    public function addRoute($method, $path, $handler) {
        $this->routes[$method][$path] = $handler;
    }
    
    public function match($method, $path) {
        if (isset($this->routes[$method][$path])) {
            return $this->routes[$method][$path];
        }
        return null;
    }
}
