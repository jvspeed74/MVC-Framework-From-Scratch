<?php

/**
 * Class UserController
 *
 * Controller responsible for managing user-related actions.
 *
 * todo logout
 * todo signup
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
        $this->session->set('username', $user->getUserID());
        $this->session->set('role', $user->getRoleID());
        $this->session->set('account-name', $user->getFirstName() . " " . $user->getLastName());
        $this->session->set('login-status', 1);
        
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
    public
    function signup(): void {
        // If the form hasn't been submitted, render the signup form.
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            UserSignupView::render();
            exit();
        }
        
        UserSignupView::render();
    }
    
    public
    function logout(): void {
        //todo
        throw new NotImplementedException();
    }
}
