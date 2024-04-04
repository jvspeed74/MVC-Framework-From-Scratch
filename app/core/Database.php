<?php

/*
File: Database.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Database {
    private $param = [
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'fitness_db',
        'tblProduct' => 'products'
    ];
    private $connection;
    static private $_instance = null;
    
    private function __construct() {
        $this->connection = @new mysqli($this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']);
        
        if (mysqli_connect_errno() != 0) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }
    }
    
    static public function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function getProductTable() {
        return $this->param['tblProduct'];
    }
}
