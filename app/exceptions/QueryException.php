<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/15/2024
 * File: DatabaseException.php
 * Description: Deals with exceptions from database operations
 */
class QueryException extends Exception {
public function __construct(string $message = "", int $code = 400, ?Throwable $previous = null) {
    parent::__construct($message, $code, $previous);
}
}
