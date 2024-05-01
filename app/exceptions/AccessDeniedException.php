<?php


/**
 * todo document
 */
class AccessDeniedException extends Exception {
    /**
     * Constructs a AccessDeniedException instance with an optional error message.
     *
     * @param string $message The error message.
     */
    public function __construct(string $message = "A user without appropriate privileges tried to access a restricted page.") {
        parent::__construct($message);
    }
}
