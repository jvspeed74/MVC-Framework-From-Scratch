<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/9/24
 * File: ProductShowView.php
 * Description:
 */

class ProductShowView extends View {
    public function display($product) {
        parent::displayHeader(); ?>
        <body>
        <h1>Product Details</h1>
        <div class="products">
            <?php
            // Check if products array is not empty
            if (!empty($product)) {
                // Loop through each product
                foreach ($product as $p) {
                    // Output the product details with a link to the product details page
                    echo '<div class="product">';
                    echo '<h2>' . $p->getName() . '</h2>';
                    echo '<p>ID: ' . $p->getProductID() . '</p>';
                    echo '<p>Price: $' . $p->getPrice() . '</p>';
                    echo '<p>Description: ' . $p->getDescription() . '</p>';
                    echo '</div>';
                }
            } else {
                // No products found
                echo '<p>This product does not exist.</p>';
            }
            ?>
        </div>
        </body>
        <?php parent::displayFooter();
    }
}
