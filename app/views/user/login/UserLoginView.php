<?php

/**
 * Class UserLoginView
 *
 *  todo signup page
 *  todo session to save user state
 */
class UserLoginView extends View {
    
    /**
     * Render the view based on user authentication status.
     * @param null|string $message The login failure message.
     */
    public static function render(?string $message = ''): void {
        // Display header
        parent::header('Login');
        
        // Check if user is already logged in.
        if (SessionManager::getInstance()->get('login-status') == 1) {
            self::renderLoggedInView();
            exit();
        }
        
       
        
        // Display login form
        self::loginForm();
        
        // Check if attempt failed
        if ($message) {
            // Check the signup status
            echo "<div class='form-container'>";
            echo htmlspecialchars($message);
            echo "</div>";
        }
        
        // Display footer
        parent::footer();
    }
    
    /**
     * Render the login form.
     */
    private static function loginForm(): void {
        echo '<h2>Login</h2>';
        echo '<form action="login" method="post">';
        echo 'Username: <input type="text" name="username"><br>';
        echo 'Password: <input type="password" name="password"><br>';
        echo '<input type="submit" value="Login">';
        echo '</form>';
        echo '<p><a href="signup">Sign Up</a></p>'; // Link to the signup page
        
         echo SessionManager::getInstance()->get('login-status');
    }
    
    /**
     * Render the welcome screen.
     */
    private static function renderLoggedInView(): void {
        echo '<h2>Welcome!</h2>';
        echo '<p>You are logged in.</p>';
    }
}
