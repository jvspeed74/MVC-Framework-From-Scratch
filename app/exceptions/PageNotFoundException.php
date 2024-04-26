<?php

/**
 * Class PageNotFoundException
 *
 * Exception indicating that a requested page is not found.
 */
class PageNotFoundException extends Exception {
    /**
     * Constructs a PageNotFoundException instance with an optional error message.
     *
     * @param string|null $message The error message.
     */
    public function __construct(?string $message = null) {
        if ($message === null) {
            $message = "Page not found: " . $_SERVER["REQUEST_URI"];
        }
        parent::__construct($message);
    }
}
