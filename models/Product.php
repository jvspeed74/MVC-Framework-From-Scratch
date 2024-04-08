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
    
    /**
     * @param string $productID
     * @param string $name
     * @param string $price
     * @param string $description
     */
    public function __construct(string $productID, string $name, string $price, string $description) {
        $this->productID = $productID;
        $this->name = $name;
        $this->price = $price;
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
