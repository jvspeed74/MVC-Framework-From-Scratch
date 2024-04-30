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
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Login</h2>
                            <form action="login" method="post">
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
                            <p class="mt-3">Don't have an account? <a href="signup">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
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
