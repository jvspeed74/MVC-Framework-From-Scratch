<?php

/**
 * Class CartController
 *
 * Controller responsible for managing the shopping cart.
 */
class CartController extends Controller {
    
    /**
     * CartController constructor.
     *
     * Initializes the controller and sets the model property to CartModel.
     */
    public function __construct() {
        // Load CartModel
        $this->model = CartModel::getInstance();
        $this->session = SessionManager::getInstance();
    }
    
    /**
     * Renders the cart view.
     */
    public function index(): void {
        // Retrieve items from the model
        $items = $this->model->getCart();
        // Render cart view
        CartIndexView::render($items);
    }
    
    /**
     * Adds a product to the cart.
     *
     * @param mixed $id The ID of the product to add.
     *
     */
    public function add(mixed $id): void {
        try {
            // Add item to cart
            $this->model->addToCart($id);
            // Redirect to cart index
            $this->index();
        } catch (ProductNotFoundException $e) {
            $this->error($e->getMessage());
        }
        
        
    }
    
    /**
     * Removes a product from the cart.
     *
     * @param mixed $id The ID of the product to remove.
     */
    public function remove(mixed $id): void {
        // Remove item from cart
        $this->model->removeFromCart($id);
        // Redirect to cart index
        $this->index();
    }
    
    /**
     * Updates the quantities of products in the cart.
     */
    public function update(): void {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }
        
        // Update quantities based on POST data
        foreach ($_POST['quantity'] as $id => $quantity) {
            $this->model->addToCart($id, $quantity);
        }
        // Redirect to cart index
        $this->index();
    }
    
    public function checkout(): void {
        // Verify user is signed in
        if (!$this->session->get('login-status')) {
            header('Location: ' . BASE_URL . '/user/login');
            return;
        }
        
        // Destroy the cart
        $this->model->destroyCart();
        
        // Display page verifying checkout is complete.
        $this->index();
    }
}
