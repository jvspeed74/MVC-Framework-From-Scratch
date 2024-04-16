<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Database.php
 * Description: This class works as an API for database operations.
 */


class Database {
    private array $param = [
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'fitness_db',
    ];
    private mysqli $connection;
    static private ?Database $_instance = null;
    
    /**
     * Creates DB connection when called
     */
    private function __construct() {
        try {
            // Attempt database connection
            $this->connection = new mysqli(
                $this->param['host'],
                $this->param['login'],
                $this->param['password'],
                $this->param['database']
            );
            
            // Check if the connection was successful
            if ($this->connection->connect_error) {
                throw new DatabaseException($this->connection->connect_error);
            }
        } catch (mysqli_sql_exception|DatabaseException $e) {
            ExceptionHandler::handleException($e);
        }
    }
    
    /**
     * Gets the singular instance of the Database object. This is statically checked
     * to confirm there is only one Database connection being made.
     *
     * @return Database
     */
    static public function getInstance(): Database {
        if (self::$_instance == null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    
    /**
     * Send a query to the database.
     *
     * @param $sql
     * @return bool|mysqli_result
     */
    public function query($sql): mysqli_result|bool {
        try {
            // Execute the query using the query method of the mysqli object
            $result = $this->connection->query($sql);
            
            // Handle connection error
            if (!$result) {
                $this->closeConnection();
                throw new DatabaseException($this->connection->error);
            }
            
        } catch (DatabaseException $e) {
            ExceptionHandler::handleException($e);
        }
        
        // Return the result of the query
        return $result;
    }
    
    /**
     * An intermediary to use the real_escape_string method from the mysqli connection property.
     *
     * @param string $string The string to be escaped.
     * @return string An escaped string.
     */
    public function realEscapeString(string $string): string {
        return $this->connection->real_escape_string($string);
    }
    
    public function closeConnection(): void {
        try {
            if (!$this->connection->close()) {
                throw new DatabaseException($this->connection->error);
            }
        } catch (DatabaseException $e) {
            ExceptionHandler::handleException($e);
        }
    }
}