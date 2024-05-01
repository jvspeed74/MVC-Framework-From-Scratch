<?php

/**
 * Represents a model for products.
 */
class ProductModel extends Model {
    /**
     * @var Database $db Database object.
     */
    protected Database $db;
    
    /**
     * @var ProductModel|null $_instance Singleton instance of ProductModel.
     */
    static private ?ProductModel $_instance = null;
    
    /**
     * @var string $table Database table name.
     */
    private string $table = 'products';
    
    /**
     * ProductModel constructor.
     * Initializes the database connection.
     */
    private function __construct() {
        parent::__construct();
    }
    
    /**
     * Retrieves an instance of the ProductModel.
     *
     * @return ProductModel An instance of the Model.
     */
    static public function getInstance(): ProductModel {
        if (self::$_instance == null) {
            self::$_instance = new ProductModel();
        }
        return self::$_instance;
    }
    
    /**
     * Fetches all products from the database.
     *
     * Retrieves all product data from the specified database table,
     * ordered by productID in descending order.
     *
     * @return array An array containing Product objects representing all products in the database.
     */
    public function fetchAll(): array {
        // Declare SQL
        $sql = "SELECT * FROM $this->table ORDER BY productID DESC";
        
        // Query DB for data
        $query = $this->db->query($sql);
        
        // Create product obj from result
        $results = [];
        while ($row = $query->fetch_object(Product::class)) {
            $results[] = $row;
        }
        
        // Return list of Product objects
        return $results;
    }
    
    /**
     * Fetches a product from the database by its ID.
     *
     * Retrieves product data from the database corresponding to the provided ID.
     *
     * @param string $id The ID of the product to fetch.
     * @return Product|null A Product object if the product is found, null if not found.
     */
    public function fetchByID(string $id): ?Product {
        // Request product from DB
        $sql = "SELECT * FROM $this->table WHERE productID='$id'";
        $query = $this->db->query($sql);
        
        // Return an instance of a product with provided data
        return $query->fetch_object(Product::class);
    }
    
    /**
     * Fetches records from the database by a search parameter.
     *
     * @param string $terms The provided search terms.
     * @return array The fetched records.
     */
    public function fetchBySearch(string $terms): array {
        // Separate terms into array
        $searchTerms = explode(" ", $terms);
        
        // Escape each term to prevent SQL injection
        $escapedTerms = [];
        foreach ($searchTerms as $term) {
            $escapedTerms[] = $this->db->realEscapeString($term);
        }
        
        // Build the SQL query to search for both name and description
        $sql = "SELECT * FROM $this->table WHERE ";
        $conditions = [];
        foreach ($escapedTerms as $term) {
            $conditions[] = "(name LIKE '%$term%' OR description LIKE '%$term%')";
        }
        $sql .= implode(" AND ", $conditions);
        
        // Execute query
        $query = $this->db->query($sql);
        
        // Store results in array of Product objects
        $results = [];
        while ($row = $query->fetch_object(Product::class)) {
            $results[] = $row;
        }
        
        // Return array of resulting objects
        return $results;
    }
    
    /**
     * Creates a new record in the database.
     *
     * @param Product $product The Product object containing the information of the product to be created.
     * @return int|null The ID of the newly created record, or null if creation fails.
     */
    public function create(Product $product): ?int {
        // Escape input data to prevent SQL injection
        $escapedName = $this->db->realEscapeString($product->getName());
        $escapedPrice = $this->db->realEscapeString($product->getPrice());
        $escapedDescription = $this->db->realEscapeString($product->getDescription());
        
        // Prepare SQL query
        $sql = "INSERT INTO $this->table (name, price, description) VALUES ('$escapedName', '$escapedPrice', '$escapedDescription')";
        
        // Execute query
        $this->db->query($sql);
        
        // Return ID of the newly inserted record
        return $this->db->getInsertionID();
    }
}
