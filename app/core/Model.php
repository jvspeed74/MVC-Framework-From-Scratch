<?php

/**
 * File: Model.php
 * Created By: Jalen Vaughn
 * Date: 4/9/2024
 * Description: Creates an abstract class Model that contains the base functionality of each inherited model.
 */
abstract class Model {
    
    protected Database $db;
    
    /**
     * Model constructor.
     * Initializes the database connection.
     */
    protected function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Returns an instance of the concrete class implementing this abstract class
     */
    abstract static public function getInstance();
}

