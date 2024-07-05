<?php

namespace PhpWebFramework\core;

/**
 * Abstract class Model
 *
 * Base class for models in the application.
 */
abstract class Model
{
    /**
     * @var Database The database connection instance.
     */
    protected Database $db;
    
    /**
     * Model constructor.
     * Initializes the database connection.
     */
    protected function __construct()
    {
        // Initialize the database connection
        $this->db = Database::getInstance();
    }
    
    /**
     * Returns an instance of the concrete class implementing this abstract class.
     *
     * This method should be implemented by concrete subclasses to return an instance of the concrete class.
     */
    abstract static public function getInstance();
}
