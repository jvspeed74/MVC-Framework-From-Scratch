<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Product.php
 * Description:
 */


class Product {
    private string $productID;
    private string $name;
    private string $price;
    private string $description;
    
    public function setProductID(string $productID): void {
        $this->productID = $productID;
    }
    
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    public function setPrice(string $price): void {
        $this->price = $price;
    }
    
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    
    public function getProductID(): string {
        return $this->productID;
    }
    
    public function getName(): string {
        return $this->name;
    }
    
    public function getPrice(): string {
        return $this->price;
    }
    
    public function getDescription(): string {
        return $this->description;
    }
    
}
