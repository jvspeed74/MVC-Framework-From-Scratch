<?php
/**
 * NOTE: Login Account Details
 *
 * username: admin
 * password: admin
 *
 * This provides you with the "create" feature on the main product page.
 *
 * It also allows you to check out products in the shopping cart.
 */

namespace PhpWebFramework\views\product;

use PhpWebFramework\core\AccountManager;
use PhpWebFramework\exceptions\AccessDeniedException;
use const PhpWebFramework\core\BASE_URL;

/**
 * Class ProductCreateView
 *
 * Represents the view for creating a new product.
 */
class ProductCreateView extends ProductView
{
    /**
     * Renders the product creation form.
     *
     * This method outputs the HTML content for displaying a form to create a new product.
     * It includes input fields for the product name, price, and description, along with a submit button.
     *
     * @param string $message
     * @return void
     * @throws AccessDeniedException
     */
    public static function render(string $message = ''): void
    {
        parent::header("Product Creation");
        // Verify user has access to this page.
        if (!AccountManager::getInstance()->isAdmin()) {
            throw new AccessDeniedException();
        }
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
        if (!empty($message)) {
            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
        parent::footer();
    }
}

