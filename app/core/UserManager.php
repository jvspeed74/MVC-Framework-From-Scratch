<?php

//todo document
class UserManager {
    private UserModel $userModel;
    private SessionManager $sessionManager;
    
    public function __construct(UserModel $userModel, SessionManager $sessionManager) {
        $this->userModel = $userModel;
        $this->sessionManager = $sessionManager;
    }
    
    /**
     * Handles user login.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     * @return bool True if the login is successful, false otherwise.
     */
    public function login(string $username, string $password): bool {
        $user = $this->userModel->verifyUserCredentials($username, $password);
        if ($user) {
            // Start session
            $this->sessionManager->startSession();
            
            // Set session data
            $this->sessionManager->set(['username' => $user->getUserID()]);
            $this->sessionManager->set(['account-name' => $user->getFirstName()]);
            $this->sessionManager->set(['login-status' => 1]);
            
            // Login successful
            return true;
        }
        // Login failure
        return false;
    }
    
    public function logout(): void {
        // Start session
        $this->sessionManager->startSession();
        
        // Delete session data pertaining to user
        $this->sessionManager->set(['username' => null]);
        $this->sessionManager->set(['account-name' => null]);
        $this->sessionManager->set(['login-status' => null]);
    }
}
