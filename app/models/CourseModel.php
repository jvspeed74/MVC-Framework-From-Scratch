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
    
    public function fetchByDate($date) {
        $sql = "SELECT * FROM $this->table WHERE date = '$date'";
        $query = $this->db->query($sql);
        
        $results = [];
        while ($row = $query->fetch_assoc()) {
            // Create an associative array to store the object information
            $courseData = [
                'courseID' => $row['courseID'],
                'title' => $row['title'],
                'description' => $row['description'],
                'date' => $row['date'],
                'startTime' => $row['startTime'],
                'endTime' => $row['endTime']
            ];
            // Add the associative array to the results array
            $results[] = $courseData;
        }
        return $results;
    }
    
    
    /**
     * @inheritDoc
     */
    public
    function update(): bool {
        // TODO: Implement update() method.
    }
    
    /**
     * @inheritDoc
     */
    public
    function delete(): bool {
        // TODO: Implement delete() method.
    }
    
    public
    function fetchByID(string $id): mixed {
        // TODO: Implement fetchByID() method.
    }
    
    public
    function fetchAll(): array {
        // TODO: Implement fetchAll() method.
    }
    
    public
    function fetchBySearch(string $terms): array {
        // TODO: Implement fetchBySearch() method.
    }
}
