<?php

/**
 * Class ProductIndexView
 *
 * Represents the view for displaying a list of products.
 */
class ProductIndexView extends ProductView {
    
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
        parent::header("Shop");
        ?>
        <!-- Section-->
        <section class="py-5" xmlns="http://www.w3.org/1999/html">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php
                    // Check if products array is not empty
                    if (!empty($products)) {
                        // Loop through each product
                        foreach ($products as $product) {
                            // Output the product info
                            ?>
                            <div class="col mb-5">
                                <div class="card h-100">
                                    <?php if ($product->getOnSale()) {
                                        // Sale Badge
                                        echo '<div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>';
                                    } ?>
                                    <!-- Product image-->
                                    <img class="card-img-top" style="height: 300px"
                                         src="<?= IMG_URL . $product->getImage() ?>"
                                         alt="..."/>
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">
                                                <a class="link-dark text-decoration-underline"
                                                   href="<?= BASE_URL ?>/product/show/<?= $product->getProductID() ?>"><?= $product->getName() ?></a>
                                            </h5>
                                            <!-- Product reviews-->
                                            <?php if ($product->getRating() != null) {
                                                // Print review star amount dynamically
                                                $maxStarAmount = 5;
                                                $fullStars = (integer)$product->getRating();
                                                ?>
                                                <div class="d-flex justify-content-center small text-warning mb-2">
                                                    <?php
                                                    for ($i = 0; $i < $fullStars; $i++) {
                                                        echo '<div class="bi-star-fill"></div>';
                                                    }
                                                    for ($i = 0; $i < ($maxStarAmount - $fullStars); $i++) {
                                                        echo '<div class="bi-star"></div>';
                                                    }
                                                    ?>


                                                </div>
                                            <?php } ?>
                                            <!-- Product price-->
                                            <?php if ($product->getOnSale() && $product->getDiscountPrice() != null) {
                                                // Show discounted price
                                                echo '<span class="text-muted text-decoration-line-through">$' . $product->getPrice() . '</span><br>';
                                                echo "$" . $product->getDiscountPrice();
                                            } else {
                                                // Show regular price
                                                echo "$" . $product->getPrice();
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto"
                                               href="<?= BASE_URL ?>/cart/add/<?= $product->getProductID() ?>">Add to
                                                Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<h1 class="display-4 fw-bolder text-black">No products found</h1>';
                    }
                    // Allow to create feature if user is logged in and has a valid account role
                    if (AccountManager::getInstance()->isAdmin()) {
                        ?>
                        <!-- Card to Create new Product-->
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">
                                            <a class="link-dark text-decoration-underline"
                                               href="<?= BASE_URL ?>/product/create">Create New Product</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <?php
        parent::footer();
    }
}

