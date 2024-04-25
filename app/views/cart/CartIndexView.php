<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/24/2024
 * File: CartIndexView.php
 * Description:
 */
class CartIndexView extends View {
    public static function render($items=[]): void {
        parent::header(); ?>
        <!--Page Specific Content-->
        <h1>Shopping Cart</h1>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item['product']->getName() ?></td>
                    <td>$<?= $item['product']->getPrice() ?></td>
                    <td>
                        <form method="post" action="<?= BASE_URL ?>/cart/update">
                            <input type="number" name="quantity[<?= $item['product']->getProductID() ?>]"
                                   value="<?= $item['quantity'] ?>" min="1">
                            <input type="submit" value="Update">
                        </form>
                    </td>
                    <td>$<?= $item['product']->getPrice() * $item['quantity'] ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/cart/remove/<?= $item['product']->getProductID() ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
<!--        <p>Total Price: $--><?php //= $totalPrice ?><!--</p>-->
        <a href="<?= BASE_URL ?>/cart/checkout">Proceed to Checkout</a>
        <?php
        parent::footer();
    }
}
