<?php

/**
 * Class ProductCreateView
 *
 * Represents the view for creating a new product.
 */
class ProductCreateView extends ProductView {
    /**
     * Renders the product creation form.
     *
     * This method outputs the HTML content for displaying a form to create a new product.
     * It includes input fields for the product name, price, and description, along with a submit button.
     *
     * @return void
     */
    public static function render(): void {
        parent::header("Product Creation");
        ?>
        <!-- Page Content-->
        <div class="compact-product">
            <h2>Create Product</h2>
            <form action="<?= BASE_URL ?>/product/create" method="POST">
                <div class="form-group">
                    <div>
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="50" required>
                    </div>
                    <div>
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" min="0.00" max='100.00'
                               step="0.01" required>
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" maxlength="5000"
                                  required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <?php
        parent::footer();
    }
}

