<?php

namespace PhpWebFramework\views\home;
use HomeBaseView;

/**
 * Author: Jalen Vaughn
 * Date: 4/27/2024
 * File: HomeIndexView.php
 * Description:
 */
class HomeIndexView extends HomeBaseView
{
    public static function render(): void
    {
        parent::header('Home');
        ?>
        <!-- Page Specific Content -->
        
        <?php
        
        parent::footer();
    }
}
