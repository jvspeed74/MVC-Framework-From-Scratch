<?php
/**
 * File: Model.php
 * Created By: Jalen Vaughn
 * Date: 4/9/2024
 * Description: Creates an abstract class Model that contains the base functionality of each inherited model.
 */

abstract class Model {
    
    protected Database $db;
    
    /**
     * Model constructor.
     * Initializes the database connection.
     */
    protected function __construct() {
        $this->db = Database::getInstance();
    }
    
    /**
     * Returns an instance of the concrete class implementing this abstract class
     */
    abstract static public function getInstance();
    
    /**
     * Fetches a record from the database by its ID.
     *
     * @param int $id The ID of the record to fetch.
     * @return mixed The fetched record
     */
    abstract public function fetchByID(int $id): mixed;
    
    /**
     * Fetches all records from the database.
     *
     * @return array An array containing all fetched records.
     */
    abstract public function fetchAll(): array;
    
    /**
     * Fetches records from the database by a search parameter.
     *
     * @return array The fetched record.
     */
    abstract public function fetchBySearch(): array;
    
    /**
     * Creates a new record in the database.
     *
     * @return bool True if the record creation was successful, false otherwise.
     */
    abstract public function create(): bool;
    
    /**
     * Updates an existing record in the database.
     *
     * @return bool True if the record update was successful, false otherwise.
     */
    abstract public function update(): bool;
    
    /**
     * Deletes an existing record from the database.
     *
     * @return bool True if the record deletion was successful, false otherwise.
     */
    abstract public function delete(): bool;
}

