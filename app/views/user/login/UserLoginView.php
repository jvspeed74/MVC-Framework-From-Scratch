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
        
        // Get session instance
        $session = SessionManager::getInstance();
        
        // Check if user is logged in
        if ($session->get('login-status')) {
            // Display welcome message ?>
            <h2>Welcome <?= $session->get('account-name') ?>!</h2>
            <p>You are logged in.</p>
            <?php
        } else {
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
        <form action="login" method="post">
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
        <p><a href="signup">Sign Up</a></p>
        <?php
    }
}
