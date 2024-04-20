<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/9/24
 * File: ProductShowView.php
 * Description: Contains the show page for the ProductController.
 */


class ProductShowView extends View {
    
    /**
     * Renders the product show view.
     *
     * This method outputs the HTML content for displaying details of a single product.
     * It includes the header, product details, and footer.
     *
     * @param Product|null $product The product object to display details of.
     * @return void
     */
    static public function render(?Product $product): void {
        parent::header("View Product"); ?>
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
        <?php parent::footer();
    }
}

