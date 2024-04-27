<?php

/**
 * Class UserSignupView
 */
class UserSignupView extends View {
    
    /**
     * Render the signup form.
     */
    public static function render($message = ''): void {
        // Display header
        parent::header('Signup');
        
        // Display signup form
        self::signupForm();
        
        if ($message) {
            // Check the signup status
            echo "<div class='form-container'>";
            echo htmlspecialchars($message);
            echo "</div>";
        }
        
        # Display footer
        parent::footer();
    }
    
    private static function signupForm(): void {
        echo '<h2>Sign Up</h2>';
        echo '<form action="signup" method="post">';
        echo 'Username: <input type="text" name="username"><br>';
        echo 'Password: <input type="password" name="password"><br>';
        echo 'Confirm Password: <input type="password" name="confirm_password"><br>';
        echo '<input type="submit" value="Sign Up">';
        echo '</form>';
    }
}
