<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/16/2024
 * File: ProductCreateView.php
 * Description:
 */
class ProductCreateView extends View {
    public static function render() {
        parent::header();
?>
        <!-- Page Content-->
        <div class="container">
            <h2>Create Product</h2>
            <form action="<?=BASE_URL?>/product/create" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
<?php
        parent::footer();
    }
}

