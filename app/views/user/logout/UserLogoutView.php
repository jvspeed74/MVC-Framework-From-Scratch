<?php
//todo document
class UserLogoutView extends View {
    public static function render(): void {
        parent::header('Logout'); ?>
        <!-- Page Specific Content -->
        <p>You have successfully been logged out. Thank you for visiting!</p>
        <?php
        parent::footer();
    }
}
