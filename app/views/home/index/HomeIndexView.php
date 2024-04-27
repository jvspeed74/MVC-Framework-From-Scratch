<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/27/2024
 * File: HomeIndexView.php
 * Description:
 */
class HomeIndexView extends HomeView {
    public static function render(): void {
        parent::header('Home');
        ?>
        <!-- Page Specific Content -->
        
        <?php
        
        parent::footer();
    }
}
