<?php

/**
 * Class ProductShowView
 *
 * Represents the view for displaying details of a single product.*
 */
class ProductShowView extends ProductView {
    
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
                echo '<img src="' . IMG_URL . $product->getImage() . '" alt="' . $product->getName() . '" class="img-fluid product-image" style="width: 200px; height: 200px;">';
                echo '<p>Price: $' . $product->getPrice() . '</p>';
                echo '<p>Description: ' . $product->getDescription() . '</p>';
            } else {
                // Product not found
                echo '<p>This product does not exist.</p>';
            }
            ?>
            <p><a href="<?= BASE_URL ?>/product/index" class="btn btn-primary">Back to Product Page</a></p>
        </div>
        </body>
        <?php parent::footer();
    }
}

?>

