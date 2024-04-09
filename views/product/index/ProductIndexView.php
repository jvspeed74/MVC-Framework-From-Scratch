<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ShopIndexView.php
 * Description:
 */
class ProductIndexView extends View {
    public function display($products): void {
        parent::displayHeader();
        ?>
        <body>
        <h1>Products</h1>
        <div class="product">
            <?php
            // Check if products array is not empty
            if ($products) {
                // Loop through each product
                foreach ($products as $p) {
                    // Output the product details with a link to the product details page
                    echo '<div class="product">';
                    echo '<h2><a href="' . BASE_URL . '/product/show/' . $p->getProductID() . '">' . $p->getName() . '</a></h2>';
                    echo '<p>Price: $' . $p->getPrice() . '</p>';
                    echo '</div>';
                }
            } else {
                // No products found
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
        </body>
        <?php
        parent::displayFooter();
    }
}
