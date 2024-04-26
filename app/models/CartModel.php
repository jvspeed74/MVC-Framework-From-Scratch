<?php

/**
 * Class CartModel
 *
 * Represents the shopping cart model responsible for managing cart items.
 * //todo throws error if two or more items are in the cart. Needs a rewrite of how it handles product objects.
 */
class CartModel {
    // Add a constant for the session key
    private const CART_SESSION_KEY = 'cart';
    
    private ProductModel $productModel;
    
    /**
     * CartModel constructor.
     *
     * Initializes the cart model with an empty array of items and an instance of the ProductModel.
     */
    public function __construct() {
        $this->productModel = ProductModel::getInstance();
        // Start or resume the session
        session_start();
        // Initialize cart if not set in session
        if (!isset($_SESSION[self::CART_SESSION_KEY])) {
            $_SESSION[self::CART_SESSION_KEY] = [];
        }
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
        
        // Check if the product is already in the cart
        if (isset($_SESSION[self::CART_SESSION_KEY][$productId])) {
            $_SESSION[self::CART_SESSION_KEY][$productId]['quantity'] += $quantity;
        } else {
            // Add new product to the cart
            $_SESSION[self::CART_SESSION_KEY][$productId] = [
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
        unset($_SESSION[self::CART_SESSION_KEY][$productId]);
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
        
        if (isset($_SESSION[self::CART_SESSION_KEY][$productId])) {
            $_SESSION[self::CART_SESSION_KEY][$productId]['quantity'] = $quantity;
        }
    }
    
    /**
     * Retrieves the items in the cart.
     *
     * @return array An array containing the cart items.
     */
    public function getItems(): array {
        return $_SESSION[self::CART_SESSION_KEY];
    }
    
    /**
     * Clears the cart.
     */
    public function clearCart(): void {
        $_SESSION[self::CART_SESSION_KEY] = [];
    }
}
