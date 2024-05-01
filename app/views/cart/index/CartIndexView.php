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
        $error = $_GET['message'] ?? '';
        ?>

            <!-- Optional Error Alert Box -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error:</strong> <?= htmlspecialchars($error) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- Cart Table -->
            <div class="table-responsive">
                <?php if (!empty($items)): ?>
                    <table class="table table-striped shadow">
                        <thead class="thead-light">
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product']->getName()) ?></td>
                                <td>$<?= htmlspecialchars(number_format($item['product']->getPrice(), 2)) ?></td>
                                <td>
                                    <form method="post" action="<?= htmlspecialchars(BASE_URL) ?>/cart/update">
                                        <input type="number" class="form-control"
                                               name="quantity[<?= $item['product']->getProductID() ?>]"
                                               value="<?= htmlspecialchars($item['quantity']) ?>" min="1">
                                        <button type="submit" class="btn btn-info btn-sm mt-2">Update</button>
                                    </form>
                                </td>
                                <td>
                                    $<?= htmlspecialchars(number_format($item['product']->getPrice() * $item['quantity'], 2)) ?></td>
                                <td>
                                    <a class="btn btn-danger btn-sm mt-2"
                                       href="<?= htmlspecialchars(BASE_URL) ?>/cart/remove/<?= $item['product']->getProductID() ?>">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info">Your cart is empty.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Include Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.5/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Link to your JavaScript file -->
        <script src="<?= PUBLIC_URL ?>/js/cart-functions.js"></script>
        
        <?php
        parent::footer();
    }
}
