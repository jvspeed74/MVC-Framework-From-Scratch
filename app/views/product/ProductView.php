<?php

/**
 * Author: Jalen Vaughn
 * Date: 4/24/2024
 * File: ProductView.php
 * Description:
 */
class ProductView extends View {
    public static function header(string $pageTitle): void {
        parent::header($pageTitle);
        ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With FitFlex</p>
                </div>
            </div>
        </header>
        <?php
    }
}
