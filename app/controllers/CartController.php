<?php

/**
 * Class CartController
 *
 * Controller responsible for managing the shopping cart.
 */
class CartController extends Controller {
    
    /**
     * @var CartModel The model instance for the shopping cart.
     */
    protected object $model;
    
    /**
     * CartController constructor.
     *
     * Initializes the controller and sets the model property to CartModel.
     */
    public function __construct() {
        parent::__construct();
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
            $this->model->addItem($id);
            $this->index();
        } catch (InvalidArgumentException $exception) {
            $this->error($exception->getMessage());
        }
    }
    
    /**
     * Removes a product from the cart.
     *
     * @param mixed $id The ID of the product to remove.
     */
    public function remove(mixed $id): void {
        $this->model->removeItem($id);
        $this->index();
    }
    
    /**
     * Updates the quantities of products in the cart.
     */
    public function update(): void {
        try {
            foreach ($_POST['quantity'] as $id => $quantity) {
                $this->model->updateQuantity($id, $quantity);
            }
            $this->index();
        } catch (InvalidArgumentException $exception) {
            $this->error($exception->getMessage());
        }
    }
    
    /**
     * Renders the cart view.
     */
    public function index(): void {
        $items = $this->model->getItems();
        CartIndexView::render($items);
    }
}
