<?php

/**
 * Class UserSignupView
 *
 * Responsible for displaying user account signup form.
 */
class UserSignupView extends View {
    
    /**
     * Render the signup form.
     */
    public static function render($message = ''): void {
        // Display header
        parent::header('Signup');
        
        // Display signup form
        self::signupForm($message);
        
        # Display footer
        parent::footer();
    }
    
    private static function signupForm($message): void {
        ?>
        <h2>Sign Up</h2>
        <form action="signup" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            Confirm Password: <input type="password" name="confirm_password"><br>
            <input type="submit" value="Sign Up">
        </form>
        <?php
        // Error message
        if ($message) {
            // Check the signup status
            echo "<div class='form-container'>";
            echo htmlspecialchars($message);
            echo "</div>";
        }
    }
}
