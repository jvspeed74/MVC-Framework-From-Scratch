<?php

/**
 * Class InvalidQuantityException
 *
 * Exception indicating that a shopping cart quantity is not valid
 */
class InvalidQuantityException extends Exception
{
    /**
     * Constructs a NotImplementedException instance with an optional error message.
     *
     * @param string $message The error message.
     */
    public function __construct(string $message = "Invalid Quantity input")
    {
        parent::__construct($message);
    }
}
