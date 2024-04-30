<?php

/**
 * Class UserController
 *
 * Controller responsible for managing user-related actions.
 *
 * todo document
 */
class UserController extends Controller {
    public function __construct() {
        $this->model = UserModel::getInstance();
        $this->session = SessionManager::getInstance();
    }
    
    /**
     * Handles the login action.
     *
     * Retrieves user credentials from POST data, verifies them,
     * and renders the appropriate view based on the verification result.
     *
     * @return void
     */
    public function login(): void {
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
        
        # Login Successful
        $this->session->set(['username' => $user->getUserID()]);
        $this->session->set(['account-name' => $user->getFirstName()]);
        $this->session->set(['login-status' => 1]);
        
        // Render appropriate view based on verification result
        UserLoginView::render();
    }
    
    /**
     * Handles the login action.
     *
     * Attempts to create a user account with the input sent from the POST request
     * and renders the appropriate view based on the verification result.
     *
     * @return void
     */
    public function signup(): void {
        // Start session
        $this->session->startSession();
        
        // If the form hasn't been submitted, render the signup form.
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            UserSignupView::render();
            exit();
        }
        
        // Ensure POST data is sent.
        $fields = [
            'first-name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'last-name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL,
            'username' => FILTER_DEFAULT,
            'password' => FILTER_DEFAULT,
            'confirm-password' => FILTER_DEFAULT,
        ];
        
        foreach ($fields as $field => $filter) {
            if (empty($_POST[$field])) {
                UserSignupView::render($field . ' is required.');
                exit();
            }
            $filteredInput = filter_var($_POST[$field], $filter);
            $trimmedInput = trim($filteredInput);
            if (empty($trimmedInput)) {
                UserSignupView::render($field . ' is required.');
                exit();
            }
            $filteredFields[$field] = $trimmedInput;
        }
        
        if (!filter_var($filteredFields['email'], FILTER_VALIDATE_EMAIL)) {
            UserSignupView::render("Invalid email address.");
            exit();
        }
        
        if ($filteredFields['password'] !== $filteredFields['confirm-password']) {
            UserSignupView::render("The passwords do not match.");
            exit();
        }
        
        if ($this->model->getUserByEmail($filteredFields['email'])) {
            UserSignupView::render("The email address is already in use.");
            exit();
        }
        
        if ($this->model->getUserByUsername($filteredFields['username'])) {
            UserSignupView::render("The username is already in use.");
        }
        
        $user = new User();
        $user->setFirstName($filteredFields['first-name']);
        $user->setLastName($filteredFields['last-name']);
        $user->setEmail($filteredFields['email']);
        $user->setUsername($filteredFields['username']);
        $user->setPassword($filteredFields['password']);
        
        $result = $this->model->create($user);
        if (!$result) {
            UserSignupView::render("An error occurred while trying to create an account.");
            exit();
        }
        
        # Login Successful
        $this->login();
    }
    
    public function logout(): void {
        // Start session
        $this->session->startSession();
        
        // Delete session data pertaining to user
        $this->session->set(['username' => null]);
        $this->session->set(['account-name' => null]);
        $this->session->set(['login-status' => null]);
        
        // Render the view
        UserLogoutView::render();
    }
}
