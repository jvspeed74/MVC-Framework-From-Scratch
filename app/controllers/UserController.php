<?php
namespace PhpWebFramework\controllers;
/**
 * Controller responsible for managing user-related actions.
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->model = UserHandler::getInstance();
        $this->session = SessionManager::getInstance();
    }
    
    /**
     * Handles the signup action.
     *
     * Attempts to create a user account with the input sent from the POST request
     * and renders the appropriate view based on the verification result.
     *
     * @return void
     */
    public function signup(): void
    {
        // Start session
        $this->session->startSession();
        
        // If the form hasn't been submitted, render the signup form.
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            UserSignupView::render();
            exit();
        }
        
        // Validate POST data
        $fields = $this->validateSignupRequest();
        
        // Create user dto
        $user = new User();
        $user->setFirstName($fields['first-name']);
        $user->setLastName($fields['last-name']);
        $user->setEmail($fields['email']);
        $user->setUsername($fields['username']);
        $user->setPassword($fields['password']);
        
        // Send request to UserHandler
        if (!$this->model->create($user)) {
            UserSignupView::render("An error occurred while trying to create an account.");
            exit();
        }
        
        # Login Successful
        $this->login();
    }
    
    /**
     * Validates the signup request data.
     *
     * @return array The validated signup request data.
     */
    public function validateSignupRequest(): array
    {
        // Ensure POST data is sent.
        $fields = [
            'first-name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'last-name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL,
            'username' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
            'confirm-password' => FILTER_DEFAULT,
        ];
        
        // Validate each field
        $filteredFields = [];
        foreach ($fields as $field => $filter) {
            // Check if data was sent
            if (empty($_POST[$field])) {
                UserSignupView::render($field . ' is required.');
                exit();
            }
            // Filter and trim the input
            $filteredInput = filter_var($_POST[$field], $filter);
            $trimmedInput = trim($filteredInput);
            if (empty($trimmedInput)) {
                UserSignupView::render($field . ' is required.');
                exit();
            }
            // Add the input to the filtered array
            $filteredFields[$field] = $trimmedInput;
        }
        
        // Validate email
        if (!filter_var($filteredFields['email'], FILTER_VALIDATE_EMAIL)) {
            UserSignupView::render("Invalid email address.");
            exit();
        }
        
        // Check if passwords match
        if ($filteredFields['password'] !== $filteredFields['confirm-password']) {
            UserSignupView::render("The passwords do not match.");
            exit();
        }
        
        // Check if email already exists
        if ($this->model->getUserByEmail($filteredFields['email'])) {
            UserSignupView::render("The email address is already in use.");
            exit();
        }
        
        // Check if username already exists
        if ($this->model->getUserByUsername($filteredFields['username'])) {
            UserSignupView::render("The username is already in use.");
            exit();
        }
        
        // Validated data. If ANYTHING went wrong the user was sent back to the signup view with the according message
        return $filteredFields;
    }
    
    /**
     * Handles the login action.
     *
     * Retrieves user credentials from POST data, verifies them,
     * and renders the appropriate view based on the verification result.
     *
     * @return void
     */
    public function login(): void
    {
        // Start session
        $this->session->startSession();
        
        // If the form hasn't been submitted, render the login form.
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            UserLoginView::render();
            exit();
        }
        
        // Check if appropriate POST data was sent in request.
        if (empty($_POST['username'])) {
            UserLoginView::render("Username is required");
            exit();
        }
        
        if (empty($_POST['password'])) {
            UserLoginView::render("Password is required");
            exit();
        }
        
        // Retrieve username and password from POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Verify user credentials
        $user = $this->model->verifyUserCredentials($username, $password);
        if (!$user) {
            UserLoginView::render("The username or password is incorrect.");
            exit();
        }
        
        // Login the account
        AccountManager::getInstance()->login($user);
        
        // Render appropriate view based on verification result
        UserLoginView::render();
    }
    
    /**
     * Logs out the current user.
     *
     * @return void
     */
    public function logout(): void
    {
        // Log user out
        AccountManager::getInstance()->logout();
        
        // Render the view
        UserLogoutView::render();
    }
}
