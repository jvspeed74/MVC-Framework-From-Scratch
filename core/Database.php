<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Database.php
 * Description: This class is the main source of connection to the Database
 */


class Database {
    private array $param = [
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'fitness_db',
        'tables' => [
            'Product' => 'products'
        ]
    ];
    
    private mysqli $connection;
    static private ?Database $_instance = null;
    
    /**
     * Creates DB connection when called
     */
    private function __construct() {
        // Attempt database connection
        $this->connection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );
        
        // Check if the connection was successful
        if ($this->connection->connect_error) {
            // todo route to error page
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    /**
     * Gets the singular instance of the Database object. This is statically checked
     * to confirm there is only one Database connection being made.
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
     * @param $sql
     * @return bool|mysqli_result|void
     */
    public function query($sql) {
        // Execute the query using the query method of the mysqli object
        $result = $this->connection->query($sql);
        
        // Check if the query was successful
        if (!$result) {
            // todo handle errors
            // If the query failed, terminate the script and output the error message
            die("Query failed: " . $this->connection->error);
        }
        
        // Return the result of the query
        return $result;
    }
}
