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
    
    private static function signupForm(?string $message): void {
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Sign Up</h2>
                            <form action="<?= BASE_URL ?>/user/signup" method="post">
                                <div class="mb-3">
                                    <label for="first-name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first-name" name="first-name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="last-name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last-name" name="last-name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm-password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm-password"
                                           name="confirm-password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </form>
                            <?php
                            // Error message
                            if ($message) {
                                // Check the signup status
                                echo '<div class="alert alert-danger">' . $message . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
