<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/21/24
 * File: UserController.php
 * Description: Controller class for user-related operations.
 */
class UserController extends Controller {
    
    /**
     * Load the UserModel.
     * @return UserModel
     */
    protected function loadModel(): object {
        return UserModel::getInstance();
    }
    
    public function loginForm(): void {
        UserLoginView::render();
    }
    
    /**
     * Login action.
     * @return void
     */
    public function login(): void {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Verify user credentials
        UserLoginView::render($this->model->verifyUserCredentials($username, $password));
    }
    
    public function signupForm(): void {
        UserSignupView::render();
    }
    
    
}

?>
