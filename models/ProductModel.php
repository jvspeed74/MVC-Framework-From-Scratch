<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ProductModel.php
 * Description:
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
    
    public function fetchAll(): array {
        // Query all products from DB
        $sql = "SELECT * FROM $this->table ORDER BY productID DESC";
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
    
    public function fetchByID(int $id): false|null|Product {
        // Request product from DB
        $sql = "SELECT * FROM $this->table WHERE productID=$id";
        $query = $this->db->query($sql);
        
        // todo check error handling
        return $query->fetch_object(Product::class);
    }
    
    /**
     * Fetches records from the database by a search parameter.
     *
     * @return array The fetched record.
     */
    public function fetchBySearch(): array {
        // TODO: Implement fetchBySearch() method.
    }
    
    /**
     * Creates a new record in the database.
     *
     * @return bool True if the record creation was successful, false otherwise.
     */
    public function create(): bool {
        // TODO: Implement create() method.
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
