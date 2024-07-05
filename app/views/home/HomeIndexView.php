<?php

namespace PhpWebFramework\views\home;

class HomeIndexView extends HomeView
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
