<?php

namespace PhpWebFramework\exceptions;

use Exception;

/**
 * Class ProductNotFoundException
 *
 * Exception indicating that a product couldn't be found.
 */
class ProductNotFoundException extends Exception
{
    /**
     * Constructs a ProductNotFoundException instance with an optional error message.
     *
     * @param string|null $message The error message.
     */
    public function __construct(?string $message = null)
    {
        if ($message === null) {
            $message = 'Product not found';
        }
        parent::__construct($message);
    }
}
