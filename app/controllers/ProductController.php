<?php


/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductController.php
 * Description:
 */
class ProductController extends Controller {
    /*
     * Initializes the controller and loads the model.
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Loads the ProductModel instance.
     *
     * @return ProductModel The ProductModel instance.
     */
    protected function loadModel(): ProductModel {
        return ProductModel::getInstance();
    }
    
    /**
     * Renders the index view displaying all products.
     *
     * This method retrieves all products from the database using the model
     * and then renders the index view with the retrieved products.
     *
     * @return void
     */
    public function index(): void {
        // Get all products from DB
        $products = $this->model->fetchAll();
        
        // Render view
        ProductIndexView::render($products);
    }
    
    /**
     * Renders the show view displaying details of a single product.
     *
     * This method queries a single product from the database using the model
     * based on the provided ID and then renders the show view with the retrieved product.
     *
     * @param mixed $id The ID of the product to display.
     * @return void
     */
    public function show(mixed $id): void {
        // Query product from DB
        $product = $this->model->fetchByID($id);
        
        // Render view
        ProductShowView::render($product);
    }
    
    /**
     * Renders the search view displaying the results of the search query.
     *
     * Searches for products based on provided terms.
     *
     * @param mixed $terms The search terms provided by the user.
     * @return void
     */
    public function search(mixed $terms): void {
        //retrieve query terms from search form
        $searchTerms = trim($terms);
        
        //if search term is empty, list all products
        if ($searchTerms == "") {
            $this->index();
        }
        
        //search the database for matching products
        $products = $this->model->fetchBySearch($searchTerms);
        
        if ($products === false) {
            //handle error
            ErrorView::render("An error occurred");
            return;
        }
        // Render view
        ProductSearchView::render($products);
        
    }
}

