<?php

//todo document
class UserLogoutView extends View {
    public static function render(): void {
        parent::header('Logout'); ?>
        <!-- Page Specific Content -->
        <div class="alert alert-success" role="alert">
            You have successfully been logged out. Thank you for visiting!
        </div>
        <?php
        parent::footer();
    }
}
