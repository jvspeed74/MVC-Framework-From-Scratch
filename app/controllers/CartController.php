<?php

/**
 * Class CartController
 *
 * Controller responsible for managing the shopping cart.
 */
class CartController extends Controller
{
    
    /**
     * CartController constructor.
     *
     * Initializes the controller and sets the model property to CartModel.
     */
    public function __construct()
    {
        // Load CartManager
        $this->model = CartManager::getInstance();
        $this->session = SessionManager::getInstance();
    }
    
    /**
     * Adds a product to the cart.
     *
     * @param mixed $id The ID of the product to add.
     *
     */
    public function add(mixed $id): void
    {
        try {
            // Add item to cart
            $this->model->addToCart($id);
            // Redirect to cart index
            $this->index();
        } catch (ProductNotFoundException $e) {
            $this->error($e->getMessage());
            return;
        }
    }
    
    /**
     * Renders the cart view.
     */
    public function index(): void
    {
        // Retrieve items from the model
        $items = $this->model->getCart();
        // Render cart view
        CartIndexView::render($items);
    }
    
    public function error($message): void
    {
        header("Location: " . BASE_URL . '/cart/index/?message=' . $message);
    }
    
    /**
     * Removes a product from the cart.
     *
     * @param mixed $id The ID of the product to remove.
     */
    public function remove(mixed $id): void
    {
        // Remove item from cart
        $this->model->removeFromCart($id);
        // Redirect to cart index
        $this->index();
    }
    
    /**
     * Updates the quantities of products in the cart.
     */
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }
        
        // Update quantities based on POST data
        foreach ($_POST['quantity'] as $id => $quantity) {
            // Validate that quantity is a positive integer
            try {
                if (!is_numeric($quantity)) {
                    // Throw critical error for non-integer inputs
                    throw new InvalidQuantityException('Invalid update quantity. Please enter an integer value.  ');
                }
            } catch (InvalidQuantityException $e) {
                $this->error($e->getMessage());
                return;
            }
            
            // Update quantity
            $this->model->updateQuantity($id, intval($quantity));
        }
        // Redirect to cart index
        $this->index();
    }
    
    public function checkout(): void
    {
        // Verify user is signed in
        if (!AccountManager::getInstance()->isLoggedIn()) {
            $message = urlencode("Please log in to continue");
            header('Location: ' . BASE_URL . '/user/login/?message=' . $message);
            return;
        }
        
        // Destroy the cart
        $this->model->destroyCart();
        
        // Display page verifying checkout is complete.
        CartCheckoutView::render();
    }
}
