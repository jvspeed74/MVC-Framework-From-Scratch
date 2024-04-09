<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/9/24
 * File: ProductShowView.php
 * Description:
 */

class ProductShowView extends View {
    public function display($product): void {
        parent::displayHeader(); ?>
        <body>
        <h1>Product Details</h1>
        <div class="product">
            <?php
            // Check if product exists
            if ($product) {
                // Output the product details
                echo '<h2>' . $product->getName() . '</h2>';
                echo '<p>Price: $' . $product->getPrice() . '</p>';
                echo '<p>Description: ' . $product->getDescription() . '</p>';
            } else {
                // Product not found
                echo '<p>This product does not exist.</p>';
            }
            ?>
        </div>
        </body>
        <?php parent::displayFooter();
    }
}
