<?php

/**
 * Class CartModel
 *
 * Represents the shopping cart model responsible for managing cart items.
 */
class CartModel {
    private array $items;
    
    private ProductModel $productModel;
    
    /**
     * CartModel constructor.
     *
     * Initializes the cart model with an empty array of items and an instance of the ProductModel.
     */
    public function __construct() {
        $this->items = [];
        $this->productModel = ProductModel::getInstance();
    }
    
    /**
     * @return CartModel
     */
    public static function getInstance(): CartModel {
        return new self();
    }
    
    /**
     * Adds an item to the cart.
     *
     * @param string $productId The ID of the product to add to the cart.
     * @param int $quantity The quantity of the product to add (default: 1).
     *
     * @throws InvalidArgumentException if the quantity is less than or equal to zero.
     * @throws InvalidArgumentException if the product with the provided ID does not exist.
     */
    public function addItem(string $productId, int $quantity = 1): void {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity must be greater than zero.");
        }
        
        $product = $this->productModel->fetchByID($productId);
        if (!$product) {
            throw new InvalidArgumentException("Product with ID $productId does not exist.");
        }
        
        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] += $quantity;
        } else {
            $this->items[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
    }
    
    /**
     * Removes an item from the cart.
     *
     * @param string $productId The ID of the product to remove from the cart.
     */
    public function removeItem(string $productId): void {
        unset($this->items[$productId]);
    }
    
    /**
     * Updates the quantity of an item in the cart.
     *
     * @param string $productId The ID of the product to update.
     * @param int $quantity The new quantity for the product.
     *
     * @throws InvalidArgumentException if the quantity is less than or equal to zero.
     */
    public function updateQuantity(string $productId, int $quantity): void {
        if ($quantity <= 0) {
            throw new InvalidArgumentException("Quantity must be greater than zero.");
        }
        
        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity'] = $quantity;
        }
    }
    
    /**
     * Retrieves the items in the cart.
     *
     * @return array An array containing the cart items.
     */
    public function getItems(): array {
        return $this->items;
    }
    
    /**
     * Calculates the total price of all items in the cart.
     *
     * @return float The total price of all items in the cart.
     * @throws NotImplementedException
     */
    public function getTotalPrice(): float {
        throw new NotImplementedException();
//        $total = 0.0;
//        foreach ($this->items as $productId => $item) {
//            $total += $item['product']->getPrice() * $item['quantity'];
//        }
//        return $total;
    }
}

