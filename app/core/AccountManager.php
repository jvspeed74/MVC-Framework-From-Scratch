<?php

namespace PhpWebFramework\core;

use PhpWebFramework\models\dto\User;

/**
 * Manages user accounts, including login, logout, and access control.
 */
class AccountManager
{
    const ACCOUNT_LOGIN_STATUS = "login-status";
    const ACCOUNT_USERNAME = 'username';
    const ACCOUNT_NAME = 'account-name';
    const ACCOUNT_ROLE = 'role';
    const ACCOUNT_PRIVILEGES = ['0' => 'None', '1' => 'Admin'];
    private static AccountManager $_instance;
    private SessionManager $sessionManager;
    
    /**
     * AccountManager constructor.
     */
    private function __construct()
    {
        $this->sessionManager = SessionManager::getInstance();
    }
    
    /**
     * Retrieves an instance of the AccountManager.
     *
     * @return AccountManager The instance of the class.
     */
    public static function getInstance(): AccountManager
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Handles user login.
     *
     * @param User $user The user object.
     * @return void
     */
    public function login(User $user): void
    {
        // Start session
        $this->sessionManager->startSession();
        
        // Set session data
        $this->sessionManager->set([self::ACCOUNT_USERNAME => $user->getUserID()]);
        $this->sessionManager->set([self::ACCOUNT_NAME => $user->getFirstName()]);
        $this->sessionManager->set([self::ACCOUNT_LOGIN_STATUS => true]);
        $this->sessionManager->set([self::ACCOUNT_ROLE => $user->getRoleID()]);
    }
    
    /**
     * Logs out the current user.
     *
     * @return void
     */
    public function logout(): void
    {
        // Start session
        $this->sessionManager->startSession();
        
        // Delete session data pertaining to user
        $this->sessionManager->set([self::ACCOUNT_USERNAME => null]);
        $this->sessionManager->set([self::ACCOUNT_NAME => null]);
        $this->sessionManager->set([self::ACCOUNT_LOGIN_STATUS => null]);
        $this->sessionManager->set([self::ACCOUNT_ROLE => null]);
    }
    
    /**
     * Checks if the logged-in user is an admin.
     *
     * @return bool True if the user is an admin, false otherwise.
     */
    public function isAdmin(): bool
    {
        return $this->isLoggedIn() && self::ACCOUNT_PRIVILEGES[$this->getAccountRole()] === 'Admin';
    }
    
    /**
     * Checks if a user is logged in.
     *
     * @return bool True if the user is logged in, false otherwise.
     */
    public function isLoggedIn(): bool
    {
        // Start Session
        $this->sessionManager->startSession();
        
        // Return login status
        return (bool)$this->sessionManager->get(self::ACCOUNT_LOGIN_STATUS);
    }
    
    /**
     * Retrieves the role of the logged-in user.
     *
     * @return mixed|null The role of the logged-in user, or null if not logged in.
     */
    public function getAccountRole(): mixed
    {
        return $this->sessionManager->get(self::ACCOUNT_ROLE);
    }
    
    /**
     * Retrieves the name of the logged-in user.
     *
     * @return mixed|null The name of the logged-in user, or null if not logged in.
     */
    public function getAccountName(): mixed
    {
        return $this->sessionManager->get(self::ACCOUNT_NAME);
    }
}
