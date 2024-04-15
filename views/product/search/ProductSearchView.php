<?php
/**
 * File: ProductSearchView.php
 * Created By: Jalen Vaughn
 * Date: 4/14/2024
 * Description: Contains the search page for the ProductController.
 */


class ProductSearchView extends View {
    static public function render(array $products = []): void {
        parent::header();
        ?>
        <body>
        <h1>Search Results</h1>
        <div class="product">
            <?php
            // Check if products array is not empty
            if (!empty($products)) {
                // Loop through each product
                foreach ($products as $product) {
                    // Output the product details with a link to the product details page
                    echo '<div class="product">';
                    echo '<h2><a href="' . BASE_URL . '/product/show/' . $product->getProductID() . '">' . $product->getName() . '</a></h2>';
                    echo '<p>Price: $' . $product->getPrice() . '</p>';
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
        parent::footer();
    }
}

