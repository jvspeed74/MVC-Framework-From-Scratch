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


namespace PhpWebFramework\views\user;

use PhpWebFramework\core\AccountManager;use PhpWebFramework\views\View;use const PhpWebFramework\core\BASE_URL;/**
 * Class UserLoginView
 *
 * Responsible for rendering the login view.
 */
class UserLoginView extends View
{
    
    /**
     * Render the login view.
     * @param string|null $message Optional message to display (e.g., login failure message).
     */
    public static function render(?string $message = ''): void
    {
        // Display header
        parent::header('Login');
        
        // Check if user is logged in
        if (AccountManager::getInstance()->isLoggedIn()) {
            // Display welcome message
            self::renderLoggedInView();
            
        } else {
            // Check if a message was sent via query string
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
            }
            // Display login form
            self::renderLoginForm($message);
        }
        
        // Display footer
        parent::footer();
    }
    
    /**
     * Render the welcome screen.
     */
    private static function renderLoggedInView(): void
    {
        ?>
        <div class="alert alert-success" role="alert">
        <h2>Welcome <?= AccountManager::getInstance()->getAccountName() ?>!</h2>
        <p>You are logged in.</p>
        <?php
    }
    
    /**
     * Render the login form.
     * @param string|null $message Option
     */
    private static function renderLoginForm(?string $message = ''): void
    {
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Login</h2>
                            <form action="<?= BASE_URL ?>/user/login" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                            <?php
                            if ($message) {
                                echo '<div class="alert alert-danger">' . $message . '</div>';
                            }
                            ?>
                            <p class="mt-3">Don't have an account? <a href="<?= BASE_URL ?>/user/signup">Sign Up</a></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
