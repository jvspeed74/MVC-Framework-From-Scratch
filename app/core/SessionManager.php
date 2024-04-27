<?php

/**
 * Class SessionManager
 *
 * A singleton class to manage sessions in the application.
 */
class SessionManager {
    /**
     * @var SessionManager The singleton instance of the SessionManager class.
     */
    private static SessionManager $_instance;
    
    /**
     * SessionManager constructor.
     * Prevent instantiation from outside the class.
     */
    private function __construct() {
        // Prevent instantiation
    }
    
    /**
     * Get the singleton instance of the SessionManager class.
     * @return SessionManager The singleton instance.
     */
    public static function getInstance(): SessionManager {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Start a session if not already started.
     * @return void
     */
    public function startSession(): void {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Set a session variable.
     * @param string $key The key of the session variable.
     * @param mixed $value The value to set.
     * @return void
     */
    public function set(string $key, mixed $value): void {
        $_SESSION[$key] = $value;
    }
    
    /**
     * Get the value of a session variable.
     * @param string $key The key of the session variable.
     * @return mixed|null The value of the session variable if found, null otherwise.
     */
    public function get(string $key): mixed {
        return $_SESSION[$key] ?? null;
    }
    
    /**
     * Destroy the session.
     * @return void
     */
    public function destroy(): void {
        session_destroy();
    }
    
    /**
     * Check if a session is active.
     * @return bool True if a session is active, false otherwise.
     */
    public function isActive(): bool {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
