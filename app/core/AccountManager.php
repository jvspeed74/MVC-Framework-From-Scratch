<?php

//todo document
class AccountManager {
    private static AccountManager $_instance;
    private SessionManager $sessionManager;
    const ACCOUNT_LOGIN_STATUS = "login-status";
    const ACCOUNT_USERNAME = 'username';
    const ACCOUNT_NAME = 'account-name';
    const ACCOUNT_ROLE = 'role';
    
    private function __construct() {
        $this->sessionManager = SessionManager::getInstance();
    }
    
    /**
     * Retrieves an instance of the UserModel.
     *
     * @return AccountManager The instance of the class.
     */
    public static function getInstance(): AccountManager {
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
        $this->sessionManager->set([self::ACCOUNT_USERNAME => $user->getUserID()]);
        $this->sessionManager->set([self::ACCOUNT_NAME => $user->getFirstName()]);
        $this->sessionManager->set([self::ACCOUNT_LOGIN_STATUS => 1]);
    }
    
    public function logout(): void {
        // Start session
        $this->sessionManager->startSession();
        
        // Delete session data pertaining to user
        $this->sessionManager->set([self::ACCOUNT_USERNAME => null]);
        $this->sessionManager->set([self::ACCOUNT_NAME => null]);
        $this->sessionManager->set([self::ACCOUNT_LOGIN_STATUS => null]);
    }
    
    public function isLoggedIn(): bool {
        // Start Session
        $this->sessionManager->startSession();
        
        // Return login status
        return (bool)$this->sessionManager->get(self::ACCOUNT_LOGIN_STATUS);
    }
    
    public function getAccountName() {
        return $this->sessionManager->get(self::ACCOUNT_NAME);
    }
}
