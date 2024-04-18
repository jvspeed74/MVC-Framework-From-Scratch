<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductModel.php
 * Description: Model directly tied to the representation of the Product object.
 */


class ProductModel extends Model {
    protected Database $db;  // Database object
    static private ?ProductModel $_instance = null;
    private string $table = 'products';
    
    private function __construct() {
        parent::__construct();
    }
    
    /**
     * @return ProductModel An instance of the Model.
     */
    static public function getInstance(): ProductModel {
        if (self::$_instance == null) {
            self::$_instance = new ProductModel();
        }
        return self::$_instance;
    }
    
    
    /**
     * @throws QueryException
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
        
        // List of Product objects
        //todo check error handling
        return $results;
    }
    
    public function fetchByID($id): false|null|Product {
        //todo throws exception if user manually types in string into browser where ID
        
        // Request product from DB
        $sql = "SELECT * FROM $this->table WHERE productID=$id";
        $query = $this->db->query($sql);
        
        // todo check error handling
        return $query->fetch_object(Product::class);
    }
    
    /**
     * Fetches records from the database by a search parameter.
     *
     * @param string $terms The provided search terms.
     * @return array The fetched record.
     * @throws QueryException
     */
    public function fetchBySearch(string $terms): array {
        // separate terms into array
        $searchTerms = explode(" ", $terms);
        
        // Escape each term to prevent SQL injection
        $escapedTerms = [];
        foreach ($searchTerms as $term) {
            $escapedTerms[] = $this->db->realEscapeString($term);
        }
        
        // sql for search
        $sql = "SELECT * FROM $this->table WHERE name LIKE '%" . array_shift($escapedTerms) . "%'";
        
        // pass each term in array
        foreach ($escapedTerms as $term) {
            $sql .= " AND name LIKE '%$term%'";
        }
        
        // execute query
        $query = $this->db->query($sql);
        
        //todo query could fail and send false
        //search succeeded, but no movie was found.
        if ($query->num_rows == 0)
            return [];
        
        // store results in array of Product objects
        $results = [];
        while ($row = $query->fetch_object(Product::class)) {
            $results[] = $row;
        }
        return $results;
    }
    
    /**
     * Creates a new record in the database.
     *
     * @param object $dataObj The Product object containing the information of the product to be created.
     * @return int|null The ID of the newly created record, or null if creation fails.
     * @throws QueryException if there is an error in the query.
     */
    public function create(object $dataObj): ?int {
        // Escape the input data to prevent SQL injection
        $escapedName = $this->db->realEscapeString($dataObj->getName());
        $escapedPrice = $this->db->realEscapeString($dataObj->getPrice());
        $escapedDescription = $this->db->realEscapeString($dataObj->getDescription());
        
        // Prepare the SQL query
        $sql = "INSERT INTO $this->table (name, price, description) VALUES ('$escapedName', '$escapedPrice', '$escapedDescription')";
        
        // Execute the query
        if ($this->db->query($sql)) {
            // Return the ID of the newly inserted record
            return $this->db->insertId();
        } else {
            // Return null if insertion fails
            //todo Query exception somewhere
            return null;
        }
    }
    
    /**
     * Updates an existing record in the database.
     *
     * @return bool True if the record update was successful, false otherwise.
     */
    public function update(): bool {
        // TODO: Implement update() method.
    }
    
    /**
     * Deletes an existing record from the database.
     *
     * @return bool True if the record deletion was successful, false otherwise.
     */
    public function delete(): bool {
        // TODO: Implement delete() method.
    }
}
