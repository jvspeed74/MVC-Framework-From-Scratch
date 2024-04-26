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
        parent::__construct();
        // Load CartModel
        $this->model = $this->loadModel();
    }
    
    /**
     * Loads the CartModel.
     *
     * @return CartModel The CartModel instance.
     */
    protected function loadModel(): CartModel {
        return new CartModel();
    }
    
    /**
     * Adds a product to the cart.
     *
     * @param mixed $id The ID of the product to add.
     *
     * @throws InvalidArgumentException if the product ID is invalid.
     */
    public function add(mixed $id): void {
        try {
            // Add item to cart
            $this->model->addItem($id);
            // Redirect to cart index
            $this->index();
        } catch (InvalidArgumentException $exception) {
            // Handle invalid product ID
            $this->error($exception->getMessage());
        }
    }
    
    /**
     * Removes a product from the cart.
     *
     * @param mixed $id The ID of the product to remove.
     */
    public function remove(mixed $id): void {
        // Remove item from cart
        $this->model->removeItem($id);
        // Redirect to cart index
        $this->index();
    }
    
    /**
     * Updates the quantities of products in the cart.
     */
    public function update(): void {
        try {
            // Update quantities based on POST data
            foreach ($_POST['quantity'] as $id => $quantity) {
                $this->model->updateQuantity($id, $quantity);
            }
            // Redirect to cart index
            $this->index();
        } catch (InvalidArgumentException $exception) {
            // Handle invalid quantity or product ID
            $this->error($exception->getMessage());
        }
    }
    
    /**
     * Renders the cart view.
     */
    public function index(): void {
        // Retrieve items from the model
        $items = $this->model->getItems();
        // Render cart view
        CartIndexView::render($items);
    }
}
