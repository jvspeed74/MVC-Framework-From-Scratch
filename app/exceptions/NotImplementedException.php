<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/24/2024
 * File: NotImplementedException.php
 * Description:
 */
class NotImplementedException extends Exception {
    public function __construct() {
        parent::__construct("The code ran is not implemented yet.");
    }
}
