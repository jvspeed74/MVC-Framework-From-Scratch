<?php
/**
 * NOTE: Login Account Details
 *
 * username: admin
 * password: admin
 *
 * This provides you with the "create" feature on the main product page.
 *
 * It also allows you to check out products in the shopping cart.
 */

namespace PhpWebFramework\views\cart;

use const PhpWebFramework\core\BASE_URL;

/**
 * Class CartCheckoutView
 *
 * Represents the view for cart checkout.
 *
 *
 */
class CartCheckoutView extends CartView
{
    
    /**
     * Renders the checkout page.
     */
    public static function render(): void
    {
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
