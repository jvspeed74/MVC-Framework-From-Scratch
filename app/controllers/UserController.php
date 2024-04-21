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
    
    public function index(): void {
        UserIndexView::render();
    }
    
    /**
     * Login action.
     * @return void
     */
    public function login(): void {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Verify user credentials
        UserIndexView::render($this->model->verifyUserCredentials($username, $password));
    }
    
    
}

?>
