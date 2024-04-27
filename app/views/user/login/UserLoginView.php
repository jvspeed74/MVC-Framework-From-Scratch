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
        parent::header('Login');
        
        if (SessionManager::getInstance()->get('login-status')) {
            self::renderLoggedInView(SessionManager::getInstance()->get('account-name'));
        } else {
            self::renderLoginForm($message);
        }
        
        parent::footer();
    }
    
    /**
     * Render the login form.
     * @param string|null $message Optional message to display (e.g., login failure message).
     */
    private static function renderLoginForm(?string $message = ''): void {
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
    
    /**
     * Render the welcome screen.
     */
    private static function renderLoggedInView($name): void {
        ?>
        <h2>Welcome <?= $name ?>!</h2>
        <p>You are logged in.</p>
        <?php
    }
}
