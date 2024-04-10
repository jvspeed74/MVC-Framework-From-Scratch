<?php

/*
File: ProductsModel.php
Created By: Jalen Vaughn
Date: 4/9/2024
Description: 
*/

class ProductsModel extends Model {
    static private ?ProductsModel $_instance = null;
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function create(): bool {
        // TODO: Implement create() method.
    }
    
    public function fetch() {
        // TODO: Implement fetch() method.
    }
    
    public function fetchAll(): array {
    
    }
    
    public function update(): bool {
        // TODO: Implement update() method.
    }
    
    public function delete(): bool {
        // TODO: Implement delete() method.
    }
    
    static public function getInstance(): ProductModel {
        if (self::$_instance == null) {
            self::$_instance = new ProductModel();
        }
        return self::$_instance;
    }
}
