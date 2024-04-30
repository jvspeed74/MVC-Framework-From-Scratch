<?php

//todo document
class CartManager {
    private static CartManager $_instance;
    private SessionManager $sessionManager;
    private array $cart;
    const CART_SESSION_KEY = 'cart';
    
    private function __construct() {
        $this->sessionManager = SessionManager::getInstance();
        $this->cart = $this->getCartFromSession();
    }
    
    public static function getInstance(): CartManager {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    private function getCartFromSession(): array {
        // Start session if not started
        $this->sessionManager->startSession();
        
        // Get the current cart from session
        return $this->sessionManager->get(self::CART_SESSION_KEY) ?? [];
    }
    
    /**
     * @throws ProductNotFoundException
     */
    public function addToCart($productID): void {
        // Grab product by its ID
        $product = ProductModel::getInstance()->fetchByID($productID);
        
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
    
    public function updateQuantity($productID, $quantity): void {
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
    
    
    public function removeFromCart($productID): void {
        // Remove the product from the cart if it exists
        if (isset($this->cart[$productID])) {
            unset($this->cart[$productID]);
            
            // Save the updated cart back to session
            $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
        }
    }
    
    public function getCart(): array {
        return $this->cart;
    }
    
    public function destroyCart(): void {
        // Destroy the cart session
        $this->cart = [];
        $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
    }
    
    /**
     * Get the total quantity of all items in the cart.
     *
     * @return int The total quantity of all items in the cart.
     */
    public function getTotalQuantity(): int {
        $totalQuantity = 0;
        
        // Iterate through each item in the cart and sum up their quantities
        foreach ($this->cart as $item) {
            if (isset($item['quantity'])) {
                $totalQuantity += $item['quantity'];
            }
        }
        
        return $totalQuantity;
    }
}
