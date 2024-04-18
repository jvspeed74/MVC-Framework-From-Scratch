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
        try {
            // Get all products from DB
            $products = $this->model->fetchAll();
            
            // Render view
            ProductIndexView::render($products);
            //todo remove try catch
        } catch (mysqli_sql_exception $e) {
            ErrorView::render("Unable to establish connection to our services. Please try again later.");
        } catch (QueryException $e) {
            ErrorView::render("There was an error processing your request.");
        }
        
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
     * @return void
     */
    public function search(): void {
        // Check if search was sent
        if ($_SERVER["REQUEST_METHOD"] !== "GET") {
            ErrorView::render("We detected unfamilar activity with your request.");
        }
        
        // Set search if not already declared
        if (!isset($_GET["search-terms"])) {
            $_GET["search-terms"] = "";
        }
        
        // Filter and trim user input
        $searchTerms = trim(filter_input(INPUT_GET, 'search-terms', FILTER_SANITIZE_SPECIAL_CHARS));
        
        // Search the database for matching products
        $products = $this->model->fetchBySearch($searchTerms);
        
        if ($products === false) {
            //handle error
            ErrorView::render("An error occurred");
            return;
        }
        // Render view
        ProductSearchView::render($products);
        
    }
    
    public function create(): void {
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // If the form hasn't been submitted, render the create view
            ProductCreateView::render();
            exit();
        } elseif ( // Confirm all POST variables are set
            !filter_has_var(INPUT_POST, 'name') ||
            !filter_has_var(INPUT_POST, 'price') ||
            !filter_has_var(INPUT_POST, 'description')) {
            ErrorView::render("We were unable to process the data entered.");
        }
        
        // Validate form data
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        
        // Create a new Product object with form data
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);
        $product->setDescription($description);
        
        // Insert the new product into the database
        try {
            $productId = $this->model->create($product);
            
            // Redirect to the show view for the newly created product
            $this->show($productId);
        } catch (Exception $e) {
            // Handle any exceptions that occur during product creation
            ExceptionHandler::handleException($e);
        }
    }
}

