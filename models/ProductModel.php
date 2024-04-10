<?php


/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductModel.php
 * Description:
 */
class ProductModel extends Model {
    protected Database $db;  // Database object (shouldn't be used outside constructor)
    protected mysqli $connection;  // Connection to database
    static private ?ProductModel $_instance = null;
    private string $table='products';
    
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
        $result = $this->connection->query($sql);
        
        // Check if query failed
        if (!$result) {
            //todo result technically failed so it should be displayed
            echo "Connection Error";
            exit();
        }
        
        // Create product obj from result
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new Product(
                $row["productID"],
                $row["name"],
                $row["price"],
                $row["description"]);
            $products[] = $product;
        }
        // List of Product objects
        return $products;
    }
    
    public function fetchByID($id): false|int|Product {
        $sql = "SELECT * FROM $this->table WHERE productID=$id";
        
        $query = $this->connection->query($sql);
        
        if (!$query) return false;
        
        if ($query->num_rows == 0) return 0;
        
        $obj = $query->fetch_object();
        
        return new Product(
            $obj->productID,
            stripslashes($obj->name),
            $obj->price,
            stripslashes($obj->description));
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
