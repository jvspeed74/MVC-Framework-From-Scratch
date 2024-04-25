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
    
    public function getUserByUsername($username): ?User {
        // Escape the username to prevent SQL injection
        $userName = $this->db->realEscapeString($username);
        
        // Build the SQL query to fetch user by username
        $sql = "SELECT * FROM users WHERE username='$userName'";
        
        // Execute the query
        $result = $this->db->query($sql);
        
        // Check if a user with the given username exists
        if ($result && $result->num_rows > 0) {
            // Fetch user data
            $userData = $result->fetch_assoc();
            
            // Create a new User object
            $user = new User();
            $user->setUserID($userData['user_id']);
            $user->setFirstName($userData['first_name']);
            $user->setLastName($userData['last_name']);
            $user->setEmail($userData['email']);
            $user->setUserName($userData['username']);
            $user->setPassword($userData['password']); // Store hashed password
            
            return $user;
        } else {
            // No user found with the given username
            return null;
        }
    }
    
    public function verifyUserCredentials($username, $password): ?User {
        // Fetch user by username
        $user = $this->getUserByUsername($username);
        
        // Check if user exists and verify password
        if ($user && password_verify($password, $user->getPassword())) {
            // Password is correct, return the user
            return $user;
        } else {
            // Invalid credentials
            return null;
        }
    }
    
    
    /**
     * Creates a new record in the database.
     *
     * @param User $user
     * @return bool True if the record creation was successful, false otherwise.
     */
    public function create(User $user): bool {
        // TODO: Implement create() method.
        // Escape user inputs to prevent SQL injection
        $firstName = $this->db->realEscapeString($user->getFirstName());
        $lastName = $this->db->realEscapeString($user->getLastName());
        $email = $this->db->realEscapeString($user->getEmail());
        $userName = $this->db->realEscapeString($user->getUserName());
        $roleID = $this->db->realEscapeString($user->getRoleID());
        
        // Hash the password
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        // Build the SQL query to insert a new user
        $sql = "INSERT INTO $this->table (first_name, last_name, email, username, password, role_id)
                VALUES ('$firstName', '$lastName', '$email', '$userName', '$hashedPassword', '$roleID')";
        
        // Execute the query
        return $this->db->query($sql);
    }
}
