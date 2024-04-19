<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: Product.php
 * Description: Data transfer object for a Product.
 */


class Product {
    private string $productID;
    private string $name;
    private string $price;
    private string $description;
    
    /**
     * @param string $productID
     * @return void
     */
    public function setProductID(string $productID): void {
        $this->productID = $productID;
    }
    
    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void {
        $this->name = $name;
    }
    
    /**
     * @param string $price
     * @return void
     */
    public function setPrice(string $price): void {
        $this->price = $price;
    }
    
    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void {
        $this->description = $description;
    }
    
    /**
     * @return string
     */
    public function getProductID(): string {
        return $this->productID;
    }
    
    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getPrice(): string {
        return $this->price;
    }
    
    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }
    
}
