<?php

//todo document
class UserManager {
    private static UserManager $_instance;
    private SessionManager $sessionManager;
    const LOGIN_STATUS = "login-status";
    const USERNAME = 'username';
    const ACCOUNT_NAME = 'account-name';
    
    private function __construct() {
        $this->sessionManager = SessionManager::getInstance();
    }
    
    /**
     * Retrieves an instance of the UserModel.
     *
     * @return UserManager The instance of the class.
     */
    public static function getInstance(): UserManager {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Handles user login.
     *
     * @param User $user
     * @return void
     */
    public function login(User $user): void {
        // Start session
        $this->sessionManager->startSession();
        
        // Set session data
        $this->sessionManager->set([self::USERNAME => $user->getUserID()]);
        $this->sessionManager->set([self::ACCOUNT_NAME => $user->getFirstName()]);
        $this->sessionManager->set([self::LOGIN_STATUS => 1]);
    }
    
    public function logout(): void {
        // Start session
        $this->sessionManager->startSession();
        
        // Delete session data pertaining to user
        $this->sessionManager->set([self::USERNAME => null]);
        $this->sessionManager->set([self::ACCOUNT_NAME => null]);
        $this->sessionManager->set([self::LOGIN_STATUS => null]);
    }
    
    public function isLoggedIn(): bool {
        // Start Session
        $this->sessionManager->startSession();
        
        // Return login status
        return (bool)$this->sessionManager->get(self::LOGIN_STATUS);
    }
    
    public function getAccountName() {
        return $this->sessionManager->get(self::ACCOUNT_NAME);
    }
}
