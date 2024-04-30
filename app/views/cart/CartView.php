<?php

/**
 * todo document
 */
class CartView extends View {
    public static function header(string $pageTitle): void {
        parent::header($pageTitle);
        echo '<h1>Shopping Cart</h1>';
    }
}
