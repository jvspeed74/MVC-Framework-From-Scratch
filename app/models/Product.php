<?php

/*
File: Product.php
Created By: diffi
Date: 4/4/2024
Description: 
*/

class Product {
    private int $productID;
    private string $name;
    private float $price;
    private string $description;
    
    /**
     * @param int $productId
     * @param string $name
     * @param float $price
     * @param string $description
     */
    public function __construct(int $productId, string $name, float $price, string $description) {
        $this->productID = $productId;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }
    
    public function getProductID(): int {
        return $this->productID;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getPrice(): float {
        return $this->price;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    

}
