<?php

/**
 * Class Product
 *
 * Data Transfer Object for the Products Table
 */
class Product {
    private ?string $productID = null;
    private ?string $name = null;
    private ?string $price = null;
    private ?string $description = null;
    private ?string $rating = null;
    private ?string $onSale = null;
    private ?string $discountPrice = null;
    private ?string $image = null;
    
    /**
     * @return string|null
     */
    public function getProductID(): ?string {
        return $this->productID;
    }
    
    /**
     * @param string|null $productID
     */
    public function setProductID(?string $productID): void {
        $this->productID = $productID;
    }
    
    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }
    
    /**
     * @param string|null $name
     */
    public function setName(?string $name): void {
        $this->name = $name;
    }
    
    /**
     * @return string|null
     */
    public function getPrice(): ?string {
        return $this->price;
    }
    
    /**
     * @param string|null $price
     */
    public function setPrice(?string $price): void {
        $this->price = $price;
    }
    
    /**
     * @return string|null
     */
    public function getDescription(): ?string {
        return $this->description;
    }
    
    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void {
        $this->description = $description;
    }
    
    /**
     * @return string|null
     */
    public function getRating(): ?string {
        return $this->rating;
    }
    
    /**
     * @param string|null $rating
     */
    public function setRating(?string $rating): void {
        $this->rating = $rating;
    }
    
    /**
     * @return string|null
     */
    public function getOnSale(): ?string {
        return $this->onSale;
    }
    
    /**
     * @param string|null $onSale
     */
    public function setOnSale(?string $onSale): void {
        $this->onSale = $onSale;
    }
    
    /**
     * @return string|null
     */
    public function getDiscountPrice(): ?string {
        return $this->discountPrice;
    }
    
    /**
     * @param string|null $discountPrice
     */
    public function setDiscountPrice(?string $discountPrice): void {
        $this->discountPrice = $discountPrice;
    }
    
    /**
     * @return string|null
     */
    public function getImage(): ?string {
        return $this->image;
    }
    
    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void {
        $this->image = $image;
    }
    
}
