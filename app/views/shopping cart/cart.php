<?php
/**
 * Author : Abrar Sabel
 * Date : 4/24/24
 * File : ?{FILE_NAME}
 * Description :
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>shopping cart</title>
</head>
<body>
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
                    <input type="number" name="quantity[<?= $item['product']->getProductID() ?>]" value="<?= $item['quantity'] ?>" min="1">
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
<p>Total Price: $<?= $totalPrice ?></p>
<a href="<?= BASE_URL ?>/checkout">Proceed to Checkout</a>
</body>
</html>

