<?php

/**
 * Class UserLoginView
 *
 * Responsible for rendering the login view.
 */
class UserLoginView extends View {
    
    /**
     * Render the login view.
     * @param string|null $message Optional message to display (e.g., login failure message).
     */
    public static function render(?string $message = ''): void {
        // Display header
        parent::header('Login');
        
        // Check if user is logged in
        if (AccountManager::getInstance()->isLoggedIn()) {
            // Display welcome message ?>
            <div class="alert alert-success" role="alert">
                <h2>Welcome <?= AccountManager::getInstance()->getAccountName() ?>!</h2>
                <p>You are logged in.</p>
            </div>
            <?php
        } else {
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
            }
            // Display login form
            self::loginForm($message);
        }
        
        // Display footer
        parent::footer();
    }
    
    /**
     * Render the login form.
     * @param string|null $message Optional message to display (e.g., login failure message).
     */
    private static function loginForm(?string $message = ''): void {
        ?>
        <h2>Login</h2>
        <form action="<?= BASE_URL ?>/user/login" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
        <?php
        if ($message) {
            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
        ?>
        <p><a href="<?= BASE_URL ?>/user/signup" class="btn btn-primary">Sign Up</a></p>
        <?php
    }
}
