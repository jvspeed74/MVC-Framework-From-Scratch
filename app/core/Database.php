<?php

namespace PhpWebFramework\core;

use mysqli;
use mysqli_result;
use mysqli_sql_exception;
use PhpWebFramework\exceptions\ExceptionHandler;

/**
 * Class Database
 *
 * Handles database connections and queries.
 */
class Database
{
    /**
     * The singular instance of the Database object.
     * @var Database|null
     */
    static private ?Database $_instance = null;
    /**
     * Database connection parameters.
     * @var array
     */
    private array $param = [
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'fitness_db',
    ];
    /**
     * The mysqli connection object.
     * @var mysqli
     */
    private mysqli $connection;
    
    /**
     * Database constructor.
     * Creates a database connection.
     * @throws mysqli_sql_exception if unable to connect to the database.
     */
    private function __construct()
    {
        try {
            // Attempt database connection
            $this->connection = new mysqli(
                $this->param['host'],
                $this->param['login'],
                $this->param['password'],
                $this->param['database']
            );
        } catch (mysqli_sql_exception $e) {
            // Handle database connection errors
            ExceptionHandler::handleException($e, "Our data services are currently unresponsive. Please try again later.");
        }
    }
    
    /**
     * Gets the singular instance of the Database object.
     * Implements the Singleton pattern.
     *
     * @return Database The Database instance.
     */
    static public function getInstance(): Database
    {
        if (self::$_instance == null) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }
    
    /**
     * Send a query to the database.
     *
     * @param string $sql The SQL query to execute.
     * @return bool|mysqli_result The result of the query.
     * @throws mysqli_sql_exception if unable to execute the query.
     */
    public function query(string $sql): mysqli_result|bool
    {
        try {
            // Execute the query
            return $this->connection->query($sql);
        } catch (mysqli_sql_exception $e) {
            // Handle query execution errors
            ExceptionHandler::handleException($e, "Unable to process the query made to our data services.");
        }
    }
    
    /**
     * Escapes special characters in a string for use in an SQL statement.
     *
     * @param string $string The string to be escaped.
     * @return string The escaped string.
     */
    public function realEscapeString(string $string): string
    {
        return $this->connection->real_escape_string($string);
    }
    
    /**
     * Get the ID generated from the previous INSERT operation.
     *
     * @return string The insertion ID.
     */
    public function getInsertionID(): string
    {
        return $this->connection->insert_id;
    }
}
