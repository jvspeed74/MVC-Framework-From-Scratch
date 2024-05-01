<?php

/**
 * Class CartCheckoutView
 *
 * Represents the view for cart checkout.
 */
class CartCheckoutView extends CartView {
    
    /**
     * Renders the checkout page.
     */
    public static function render(): void {
        parent::header('Checkout');
        ?>
        <div class="alert alert-success" role="alert">
            Thank you for your purchase!
        </div>
        <a href="<?= BASE_URL ?>/cart/index" class="btn btn-primary">Back to Shopping Cart</a>
        <?php
        parent::footer();
    }
}
