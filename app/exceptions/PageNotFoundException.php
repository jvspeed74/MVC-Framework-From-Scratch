<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/24/2024
 * File: ${FILE_NAME}
 * Description:
 */
class PageNotFoundException extends Exception {
    
    public function __construct() {
        parent::__construct("Page not found: ". $_SERVER["REQUEST_URI"]);
        http_response_code(404);
        
    }
}
