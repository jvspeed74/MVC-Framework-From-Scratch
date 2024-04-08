<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ShopIndexView.php
 * Description:
 */
class ProductIndexView extends View {
    public function display($data): void {
        ?>
        <body>
        <h1>Shop</h1>
        <div class="products">
            <?php
            // Check if products array is not empty
            if (!empty($data)) {
                // Loop through each product
                foreach ($data as $d) {
                    // Output the product details with a link to the product details page
                    echo '<div class="product">';
                    echo '<h2><a href="shop/detail/' . $d['ID'] . '">' . htmlspecialchars($d['Name']) . '</a></h2>';
                    echo '<p>Price: $' . number_format($d['Price'], 2) . '</p>';
                    echo '</div>';
                }
            } else {
                // No products found
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
        </body>
    <?php }
}
