<?php
namespace PhpWebFramework\exceptions;
/**
 * Class NotImplementedException
 *
 * Exception indicating that a piece of code is not implemented yet.
 */
class NotImplementedException extends Exception
{
    /**
     * Constructs a NotImplementedException instance with an optional error message.
     *
     * @param string $message The error message.
     */
    public function __construct(string $message = "The code is not implemented yet.")
    {
        parent::__construct($message);
    }
}
