<?php

/**
 * todo document
 */
class CartErrorView extends CartView {
    public static function render(string $message=''): void {
        parent::header('Shopping Cart Error');
        //todo lead CartController exceptions to here
    }
}
