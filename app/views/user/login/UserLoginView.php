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
        if (UserManager::getInstance()->isLoggedIn()) {
            // Display welcome message ?>
            <h2>Welcome <?= UserManager::getInstance()->getAccountName() ?>!</h2>
            <p>You are logged in.</p>
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
            echo "<div class='form-container'>";
            echo htmlspecialchars($message);
            echo "</div>";
        }
        ?>
        <p><a href="<?= BASE_URL ?>/user/signup">Sign Up</a></p>
        <?php
    }
}
