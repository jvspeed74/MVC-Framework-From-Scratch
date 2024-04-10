<?php

/*
File: Model.php
Created By: Jalen Vaughn
Date: 4/9/2024
Description: 
*/

abstract class Model {
    use QueryBuilder;
    
    protected ?string $table;
    
    protected Database $db;
    protected mysqli $connection;
    
    protected function __construct(string $tableName) {
        $this->db = Database::getInstance();
        $this->connection = $this->db->getConnection();
        $this->table = $tableName;
    }
    
    abstract static public function getInstance();
    
    abstract public function create(): bool;
    
    abstract public function fetch();
    
    abstract public function fetchAll(): array;
    
    abstract public function update(): bool;
    
    abstract public function delete(): bool;
}
