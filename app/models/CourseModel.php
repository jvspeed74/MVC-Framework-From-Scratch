<?php

/**
 * Class CourseModel
 *
 * Represents a model for courses.
 */
class CourseModel extends Model {
    /**
     * @var Database $db Database object.
     */
    protected Database $db;
    
    /**
     * @var CourseModel|null $_instance Singleton instance of CourseModel.
     */
    private static ?CourseModel $_instance = null;
    
    /**
     * @var string $table Database table name.
     */
    private string $table = 'Courses';
    
    /**
     * CourseModel constructor.
     * Initializes the database connection.
     */
    private function __construct() {
        parent::__construct();
    }
    
    /**
     * Retrieves an instance of the CourseModel.
     *
     * @return CourseModel An instance of the model.
     */
    static public function getInstance(): CourseModel {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Fetches courses from the database by date.
     *
     * @param string $date The date of the courses to fetch.
     * @return array An array containing course data.
     */
    public function fetchByDate(string $date): array {
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
}
