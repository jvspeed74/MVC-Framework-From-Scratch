<?php

/*
File: Product.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Products {
    private $db;
    private $dbConnection;
    static private $_instance = null;
    private $tblProduct;
    
    private function __construct() {
        $this->db = Database::getInstance();
        $this->dbConnection = $this->db->getConnection();
        $this->tblProduct = $this->db->getProductTable();
        
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }
    
    static public function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function getAllProducts() {
        $sql = 'SELECT * FROM '. $this->tblProduct;
        
        $query = $this->dbConnection->query($sql);
        
        if (!$query) return false;
        
        if ($query->num_rows == 0) return 0;
        
        $products = [];
        while ($obj = $query->fetch_object()) {
            $product = new Product(
                $obj->productID,
                stripslashes($obj->Name),
                $obj->Price,
                stripslashes($obj->Description)
            );
            $products[] = $product;
        }
        return $products;
    }
    
    public function getProduct($id) {
        $sql = "SELECT * FROM $this->tblProduct WHERE productID=$id";
        
        $query = $this->dbConnection->query($sql);
        
        if (!$query) return false;
        
        if ($query->num_rows == 0) return 0;
        
        $obj = $query->fetch_object();
        
        return new Product($obj->productID, stripslashes($obj->Name), $obj->Price, stripslashes($obj->Description));
    }
    
    
}
