<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: ShopIndexView.php
 * Description: Contains the index page for the ProductController.
 */


class ProductIndexView extends View {
    
    /**
     * Renders the product index view.
     *
     * This method outputs the HTML content for displaying a list of products.
     * It includes the header, product list, and footer.
     *
     * @param array $products An array containing product objects to display.
     * @return void
     */
    static public function render(array $products = []): void {
        parent::header();
        ?>
        <body>
        <?php echo (!isset($_GET['search-terms'])) ? "<h1>Products</h1>" : "<h1>Search Results</h1>"; ?>
        <div class="product-container">
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
        <div class="product"><a href="<?= BASE_URL ?>/product/create">Create new product</a></div>
        </body>
        <?php
        parent::footer();
    }
}

