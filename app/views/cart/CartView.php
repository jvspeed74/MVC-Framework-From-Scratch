<?php

namespace PhpWebFramework\views\cart;

use PhpWebFramework\core\CartManager;
use PhpWebFramework\views\View;
use const PhpWebFramework\core\BASE_URL;

/**
 * Represents the base view for the shopping cart.
 */
class CartView extends View
{
    
    /**
     * Renders the header section of the shopping cart page.
     *
     * @param string $pageTitle The title of the page.
     */
    public static function header(string $pageTitle): void
    {
        parent::header($pageTitle);
        ?>
        <!-- Bootstrap Container for centering content -->
        <div class="container my-4">
        <!-- Shopping Cart Header -->
        <div class="row">
            <div class="col">
                <h2 class="my-3">Shopping Cart</h2>
            </div>
            <div class="col-auto my-auto">
                <a href="<?= BASE_URL ?>/product/index" class="btn btn-outline-primary">Continue Shopping</a>
                
                <?php if (CartManager::getInstance()->getTotalQuantity()): ?>
                    <a href="<?= BASE_URL ?>/cart/checkout" class="btn btn-primary">Proceed to Checkout</a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
