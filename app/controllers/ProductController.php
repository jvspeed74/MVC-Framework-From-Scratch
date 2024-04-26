<?php

/**
 * Class ProductController
 *
 * Controller responsible for managing products.
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
     * Retrieves all products from the database using the model
     * and then renders the index view with the retrieved products.
     *
     * @return void
     */
    public function index(): void {
        // Get all products from the database
        $products = $this->model->fetchAll();
        
        // Render the index view
        ProductIndexView::render($products);
    }
    
    /**
     * Renders the show view displaying details of a single product.
     *
     * Queries a single product from the database using the model
     * based on the provided ID and then renders the show view with the retrieved product.
     *
     * @param string $id The ID of the product to display.
     * @return void
     */
    public function show(string $id): void {
        // Filter and trim the provided product ID
        $filteredID = htmlspecialchars(trim($id));
        
        // Query the product from the database
        $product = $this->model->fetchByID($filteredID);
        
        // Render the show view
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
        // Set default search terms if not provided
        if (!isset($_GET["search-terms"])) {
            $_GET["search-terms"] = "";
        }
        
        // Filter and trim the search terms
        $searchTerms = trim(filter_input(INPUT_GET, 'search-terms', FILTER_SANITIZE_SPECIAL_CHARS));
        
        // Search the database for matching products
        $products = $this->model->fetchBySearch($searchTerms);
        
        // Handle errors if occurred during the search
        if ($products === false) {
            $this->error("An error occurred while searching for products.");
            return;
        }
        
        // Render the search results view
        ProductIndexView::render($products);
    }
    
    /**
     * Creates a new product based on form submission data.
     *
     * Redirects to the show view for the newly created product.
     *
     * @return void
     */
    public function create(): void {
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // If the form hasn't been submitted, render the create view
            ProductCreateView::render();
            exit();
        }
        
        // Ensure all required POST variables are set
        if (!filter_has_var(INPUT_POST, 'name') ||
            !filter_has_var(INPUT_POST, 'price') ||
            !filter_has_var(INPUT_POST, 'description')
        ) {
            $this->error("We were unable to process the entered data.");
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
        $productId = $this->model->create($product);
        
        // Redirect to the show view for the newly created product
        $this->show($productId);
    }
    
    /**
     * Renders an error page with an optional message.
     *
     * @param string $message The message to be displayed to the client.
     * @return void
     */
    public function error(string $message): void {
        ErrorView::render($message);
    }
}
