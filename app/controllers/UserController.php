<?php

/**
 * Class UserController
 *
 * Controller responsible for managing user-related actions.
 *
 * @todo handle incorrect password
 * @todo combine methods (GET & POST)
 */
class UserController extends Controller {
    public function __construct() {
        $this->model = UserModel::getInstance();
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
        // If the form hasn't been submitted, render the login form.
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            UserLoginView::render();
            exit();
        }
        
        // Check if appropriate POST data was sent in request.
        if (!isset($_POST['username'])) {
            UserLoginView::render("Username is required");
            exit();
        }
        
        if (!isset($_POST['password'])) {
            UserLoginView::render("Password is required");
            exit();
        }
        
        // Retrieve username and password from POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        
        // Verify user credentials
        $user = $this->model->verifyUserCredentials($username, $password);
        if ($user) {
            # Login Successfully
            $session = SessionManager::getInstance();
            $session->set('username', $user->getUserID());
            $session->set('role', $user->getRoleID());
            $session->set('account-name', $user->getFirstName() . "" . $user->getLastName());
            $session->set('login-status', 1);
        }
        
        // Render appropriate view based on verification result
        UserLoginView::render("Success");
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
