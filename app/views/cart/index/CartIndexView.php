<?php


/**
 * Class CartIndexView
 *
 * Represents the view for displaying the shopping cart contents.
 */
class CartIndexView extends CartView {
    
    /**
     * Renders the shopping cart view.
     *
     * This method outputs the HTML content for displaying the shopping cart contents,
     * including the product details, quantity, total price, and action buttons.
     *
     * @param array $items An array containing items in the shopping cart.
     * @return void
     */
    public static function render(array $items = []): void {
        parent::header("Shopping Cart");
        $totalPrice = 0;
        if (!empty($items)) { ?>
            <!--Page Specific Content-->
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
                        <?php $totalPrice += $item['product']->getPrice() * $item['quantity']; ?>
                        <td>
                            <a href="<?= BASE_URL ?>/cart/remove/<?= $item['product']->getProductID() ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p>Total Price: $<?= $totalPrice ?></p>
            <a href="<?= BASE_URL ?>/cart/checkout" class="btn btn-primary">Proceed to Checkout</a>
            <?php
        } else {
            echo '<p>Your cart is empty</p>';
        }
        // Display footer
        parent::footer();
    }
}

?>
