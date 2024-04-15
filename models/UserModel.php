<?php
/**
 * File: UserModel.php
 * Created By: Jalen Vaughn
 * Date: 4/14/2024
 * Description: Model directly tied to the representation of the User object.
 */


class UserModel extends Model {
    protected Database $db;
    static private ?UserModel $_instance = null;
    private string $table = 'users';
    
    private function __construct() {
        parent::__construct();
    }
    
    /**
     * @return UserModel An instance of the model.
     */
    static public function getInstance(): UserModel {
        if (self::$_instance == null) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
    
    /**
     * Fetches a record from the database by its ID.
     *
     * @param int $id The ID of the record to fetch.
     * @return mixed The fetched record
     */
    public function fetchByID(int $id): mixed {
        // TODO: Implement fetchByID() method.
    }
    
    /**
     * Fetches all records from the database.
     *
     * @return array An array containing all fetched records.
     */
    public function fetchAll(): array {
        // TODO: Implement fetchAll() method.
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
