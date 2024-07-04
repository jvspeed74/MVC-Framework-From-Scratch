<?php

/**
 * Represents a model for users.
 */
class UserModel extends Model
{
    /**
     * @var UserModel|null $_instance Singleton instance of UserModel.
     */
    static private ?UserModel $_instance = null;
    /**
     * @var Database $db Database object.
     */
    protected Database $db;
    /**
     * @var string $table Database table name.
     */
    private string $table = 'users';
    
    /**
     * UserModel constructor.
     * Initializes the database connection.
     */
    private function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Retrieves an instance of the UserModel.
     *
     * @return UserModel An instance of the model.
     */
    static public function getInstance(): UserModel
    {
        if (self::$_instance == null) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
    
    /**
     * Retrieves a user from the database by their email.
     *
     * @param string $email The email of the user to retrieve.
     * @return User|null A User object if the user is found, null if not found.
     */
    public function getUserByEmail(string $email): ?User
    {
        // Escape the username to prevent SQL injection
        $escapedEmail = $this->db->realEscapeString($email);
        
        // Build the SQL query to fetch user by username
        $sql = "SELECT * FROM users WHERE email='$escapedEmail'";
        
        // Execute the query
        $result = $this->db->query($sql);
        
        // Check if a user with the given email exists
        if ($result && $result->num_rows > 0) {
            // Fetch user data
            return $result->fetch_object(User::class);
        } else {
            // No user found with the given email
            return null;
        }
    }
    
    /**
     * Verifies user credentials.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @return User|null A User object if the credentials are valid, null otherwise.
     */
    public function verifyUserCredentials(string $username, string $password): ?User
    {
        // Escape username before using it in query
        $escapedUsername = $this->db->realEscapeString($username);
        
        // Fetch user by username
        $user = $this->getUserByUsername($escapedUsername);
        
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
     * Retrieves a user from the database by their username.
     *
     * @param string $username The username of the user to retrieve.
     * @return User|null A User object if the user is found, null if not found.
     */
    public function getUserByUsername(string $username): ?User
    {
        // Escape the username to prevent SQL injection
        $escapedString = $this->db->realEscapeString($username);
        
        // Build the SQL query to fetch user by username
        $sql = "SELECT * FROM users WHERE username='$escapedString'";
        
        // Execute the query
        $result = $this->db->query($sql);
        
        // Check if a user with the given username exists
        if ($result && $result->num_rows > 0) {
            // Fetch user data
            return $result->fetch_object(User::class);
        } else {
            // No user found with the given username
            return null;
        }
    }
    
    /**
     * Creates a new user record in the database.
     *
     * @param User $user The User object containing the information of the user to be created.
     * @return bool True if the record creation was successful, false otherwise.
     */
    public function create(User $user): bool
    {
        // Escape user inputs to prevent SQL injection
        $firstName = $this->db->realEscapeString($user->getFirstName());
        $lastName = $this->db->realEscapeString($user->getLastName());
        $email = $this->db->realEscapeString($user->getEmail());
        $userName = $this->db->realEscapeString($user->getUserName());
        $roleID = $this->db->realEscapeString($user->getRoleID());
        
        // Hash the password
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        
        // Build the SQL query to insert a new user
        $sql = "INSERT INTO $this->table (firstName, lastName, email, userName, password, roleID)
                VALUES ('$firstName', '$lastName', '$email', '$userName', '$hashedPassword', '$roleID')";
        
        // Execute the query
        return $this->db->query($sql);
    }
}
