<?php
//todo document
class CartModel {
    private static CartModel $_instance;
    private SessionManager $sessionManager;
    private array $cart;
    const CART_SESSION_KEY = 'cart';
    
    private function __construct() {
        $this->sessionManager = SessionManager::getInstance();
        $this->cart = $this->getCartFromSession();
    }
    
    public static function getInstance(): CartModel {
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
    
    public function addToCart($productId, $quantity = 1): void {
        $product = ProductModel::getInstance()->fetchByID($productId);
        if (!$product) {
            throw new ProductNotFoundException();
        }
        
        // Check if the product is already in the cart
        if (isset($this->cart[$productId])) {
            // Product exists in the cart, so update its quantity
            $this->cart[$productId]['quantity'] = $quantity;
        } else {
            // Product does not exist in the cart, so add it
            $this->cart[$productId] = [
                'product' => $product,
                'quantity' => $quantity,
            ];
        }
        
        // Save the updated cart back to session
        $this->sessionManager->set([self::CART_SESSION_KEY => $this->cart]);
    }
    
    public function removeFromCart($productId): void {
        // Remove the product from the cart if it exists
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            
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
    
    
}
