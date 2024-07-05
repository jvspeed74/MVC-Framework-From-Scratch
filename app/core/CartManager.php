<?php

namespace PhpWebFramework\core;

use PhpWebFramework\exceptions\ProductNotFoundException;
use PhpWebFramework\models\handlers\ProductHandler;

/**
 * Manages the shopping cart.
 */
class CartManager
{
    const CART_SESSION_KEY = 'cart';
    private static CartManager $_instance;
    private SessionManager $sessionManager;
    private array $cart;
    
    /**
     * CartManager constructor.
     */
    private function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
        $this->cart = $this->getCartFromSession();
    }
    
    /**
     * Get the instance of CartManager.
     *
     * @return CartManager The instance of CartManager.
     */
    public static function getInstance(): CartManager
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Retrieves the cart from the session.
     *
     * @return array The cart retrieved from the session.
     */
    private function getCartFromSession(): array
    {
        // Start session if not started
        $this->sessionManager->startSession();
        
        // Get the current cart from session
        return $this->sessionManager->get(self::CART_SESSION_KEY) ?? [];
    }
    
    /**
     * Adds a product to the cart.
     *
     * @param mixed $productID The ID of the product to add.
     *
     * @throws ProductNotFoundException If the product is not found.
     */
    public function addToCart(mixed $productID): void
    {
        // Grab product by its ID
        $product = ProductHandler::getInstance()->fetchByID($productID);
        
        // Check if product exists
        if (!$product) {
            throw new ProductNotFoundException();
        }
        
        // Check if the product is already in the cart
        $quantity = 1;
        if (isset($this->cart[$productID])) {
            // Product exists in the cart, so increment its quantity
            $this->cart[$productID]['quantity'] += $quantity;
        } else {
            // Product does not exist in the cart, so add it
            $this->cart[$productID] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
        
        // Save the updated cart back to session
        $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
    }
    
    /**
     * Updates the quantity of a product in the cart.
     *
     * @param mixed $productID The ID of the product to update quantity for.
     * @param mixed $quantity The new quantity of the product.
     */
    public function updateQuantity(mixed $productID, mixed $quantity): void
    {
        // Update the quantity of the specified product in the cart
        if (isset($this->cart[$productID])) {
            // If the quantity is below 1, remove the product from the cart
            if ($quantity < 1) {
                $this->removeFromCart($productID);
            } else {
                $this->cart[$productID]['quantity'] = $quantity;
            }
        }
        
        // Save the updated cart back to session
        $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
    }
    
    
    /**
     * Removes a product from the cart.
     *
     * @param mixed $productID The ID of the product to remove.
     */
    public function removeFromCart(mixed $productID): void
    {
        // Remove the product from the cart if it exists
        if (isset($this->cart[$productID])) {
            unset($this->cart[$productID]);
            
            // Save the updated cart back to session
            $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
        }
    }
    
    /**
     * Retrieves the current cart.
     *
     * @return array The current cart.
     */
    public function getCart(): array
    {
        return $this->cart;
    }
    
    /**
     * Destroys the cart.
     */
    public function destroyCart(): void
    {
        // Destroy the cart session
        $this->cart = [];
        $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
    }
    
    /**
     * Get the total quantity of all items in the cart.
     *
     * @return int The total quantity of all items in the cart.
     */
    public function getTotalQuantity(): int
    {
        // Default counter
        $totalQuantity = 0;
        
        // Iterate through each item in the cart and sum up their quantities
        foreach ($this->cart as $item) {
            if (isset($item['quantity'])) {
                $totalQuantity += $item['quantity'];
            }
        }
        // The amount of items in the cart
        return $totalQuantity;
    }
}
