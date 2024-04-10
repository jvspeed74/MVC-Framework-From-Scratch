<?php

/*
File: Model.php
Created By: Jalen Vaughn
Date: 4/9/2024
Description: 
*/

abstract class Model {
    
    protected Database $db;
    
    protected function __construct() {
        $this->db = Database::getInstance();
    }
    
    abstract static public function getInstance();
    
    abstract public function create(): bool;
    
    abstract public function fetchByID(int $id);
    
    abstract public function fetchAll(): array;
    abstract public function fetch();
    
    abstract public function update(): bool;
    
    abstract public function delete(): bool;
}
