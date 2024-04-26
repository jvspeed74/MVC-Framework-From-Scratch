<?php

/**
 * Class UserController
 *
 * Controller responsible for managing user-related actions such as login and signup.
 *
 * @todo handle incorrect password
 * @todo combine methods (GET & POST)
 */
class UserController extends Controller {
    
    /**
     * Load the UserModel.
     *
     * @return UserModel The UserModel instance.
     */
    protected function loadModel(): object {
        return UserModel::getInstance();
    }
    
    /**
     * Renders the login form view.
     *
     * @return void
     */
    public function loginForm(): void {
        UserLoginView::render();
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
        // Retrieve username and password from POST data
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Verify user credentials
        // Render appropriate view based on verification result
        UserLoginView::render($this->model->verifyUserCredentials($username, $password));
    }
    
    /**
     * Renders the signup form view.
     *
     * @return void
     */
    public function signupForm(): void {
        UserSignupView::render();
    }
}
