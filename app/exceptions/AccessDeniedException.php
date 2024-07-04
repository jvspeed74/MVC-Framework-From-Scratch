<?php

/**
 * Represents an exception thrown when access is denied.
 */
class AccessDeniedException extends Exception
{
    
    /**
     * Constructs an AccessDeniedException instance with an optional error message.
     *
     * @param string $message The error message.
     */
    public function __construct(string $message = "A user without appropriate privileges tried to access a restricted page.")
    {
        parent::__construct($message);
    }
}
