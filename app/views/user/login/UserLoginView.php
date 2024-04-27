<?php

/**
 * Class UserIndexView
 *
 *  todo signup page
 *  todo session to save user state
 */
class UserLoginView extends View {
    
    /**
     * Render the view based on user authentication status.
     * @param User|null $user The authenticated user (null if not logged in).
     */
    public static function render(?User $user = null): void {
        // Check if the user is logged in
        parent::header('Login');
        if ($user) {
            self::renderLoggedInView($user);
        } else {
            self::renderLoginForm();
        }
    }
    
    /**
     * Render the login form.
     */
    private static function renderLoginForm(): void {
        echo '<h2>Login</h2>';
        echo '<form action="login" method="post">';
        echo 'Username: <input type="text" name="username"><br>';
        echo 'Password: <input type="password" name="password"><br>';
        echo '<input type="submit" value="Login">';
        echo '</form>';
        echo '<p><a href="signup">Sign Up</a></p>'; // Link to the signup page
    }
    
    /**
     * Render the welcome screen.
     * @param User $user The authenticated user.
     */
    private static function renderLoggedInView(User $user): void {
        echo '<h2>Welcome, ' . $user->getUsername() . '!</h2>';
        echo '<p>You are now logged in.</p>';
    }
}
