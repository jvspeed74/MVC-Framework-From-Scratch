<?php

/**
 * todo document
 */
class CartErrorView extends CartView {
    public static function render(string $message): void {
        parent::header('Shopping Cart Error');
        echo '<div class="alert alert-danger">' . $message . '</div>';
        parent::footer();
    }
}
