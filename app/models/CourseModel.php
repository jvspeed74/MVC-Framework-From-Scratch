<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/20/24
 * File: CourseModel.php
 * Description:
 */
class CourseModel extends Model {
    protected Database $db;
    private static ?CourseModel $_instance = null;
    private string $table = 'Courses';
    
    private function __construct() {
        parent::__construct();
    }
    
    /**
     * @inheritDoc
     */
    static public function getInstance(): CourseModel {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * @inheritDoc
     */
    public function fetchByID(string $id): ?Course {
        // TODO: Implement fetchByID() method.
        // Request product from DB
        $sql = "SELECT * FROM $this->table WHERE courseID='$id'";
        $query = $this->db->query($sql);
        
        // Return an instance of a product with provided data
        return $query->fetch_object(Course::class);
        
    }
    
    /**
     * @inheritDoc
     */
    public function fetchAll(): array {
        // TODO: Implement fetchAll() method.
        // Declare SQL
        $sql = "SELECT * FROM $this->table ORDER BY date";
        
        // Query DB for data
        $query = $this->db->query($sql);
        
        // Create product obj from result
        $results = [];
        while ($row = $query->fetch_object(Course::class)) {
            $results[] = $row;
        }
        
        // List of Product objects
        //todo check error handling
        return $results;
    }
    
    /**
     * @inheritDoc
     */
    public function fetchBySearch(string $terms): array {
        // TODO: Implement fetchBySearch() method.
        // separate terms into array
        $searchTerms = explode(" ", $terms);
        
        // Escape each term to prevent SQL injection
        $escapedTerms = [];
        foreach ($searchTerms as $term) {
            $escapedTerms[] = $this->db->realEscapeString($term);
        }
        
        // sql for search
        $sql = "SELECT * FROM $this->table WHERE title LIKE '%" . array_shift($escapedTerms) . "%'";
        
        // pass each term in array
        foreach ($escapedTerms as $term) {
            $sql .= " AND title LIKE '%$term%'";
        }
        
        // execute query
        $query = $this->db->query($sql);
        
        // store results in array of Product objects
        $results = [];
        while ($row = $query->fetch_object(Course::class)) {
            $results[] = $row;
        }
        return $results;
    }
    
    /**
     * @inheritDoc
     */
    public function update(): bool {
        // TODO: Implement update() method.
    }
    
    /**
     * @inheritDoc
     */
    public function delete(): bool {
        // TODO: Implement delete() method.
    }
}
