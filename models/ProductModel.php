<?php


/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductModel.php
 * Description:
 */
class ProductModel extends Model {
    protected Database $db;  // Database object
    static private ?ProductModel $_instance = null;
    private string $table = 'products';
    private array $attributes = ['productID', 'name', 'price', 'description'];
    
    private function __construct() {
        parent::__construct();
    }
    
    // Return the singular instance of the GuestModel
    static public function getInstance(): ProductModel {
        if (self::$_instance == null) {
            self::$_instance = new ProductModel();
        }
        return self::$_instance;
    }
    
    public function fetchAll(): array {
        // Query all products from DB
        $sql = "SELECT * FROM $this->table ORDER BY productID DESC";
        $query = $this->db->query($sql);
        
        // Create product obj from result
        $results = [];
        while ($row = $query->fetch_object(Product::class)) {
            $results[] = $row;
        }
        // List of Product objects
        //todo check error handling
        return $results;
    }
    
    public function fetchByID(int $id): false|null|Product {
        // Request product from DB
        $sql = "SELECT * FROM $this->table WHERE productID=$id";
        $query = $this->db->query($sql);
        // todo check error handling
        return $query->fetch_object(Product::class);
    }
    
    public function create(): bool {
        // TODO: Implement create() method.
        return false;
    }
    
    public function fetch() {
        // TODO: Implement fetch() method.
    }
    
    public function update(): bool {
        // TODO: Implement update() method.
        return false;
    }
    
    public function delete(): bool {
        // TODO: Implement delete() method.
        return false;
    }
}
