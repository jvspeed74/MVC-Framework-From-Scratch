<?php

namespace PhpWebFramework\views\product;

use PhpWebFramework\views\View;

/**
 * Class ProductBaseView
 *
 * Represents the base view for product-related pages.
 */
class ProductView extends View
{
    
    /**
     * Renders the header section of the product view.
     *
     * This method outputs the HTML content for the header section,
     * including the page title and a header banner.
     *
     * @param string $pageTitle The title of the page.
     * @return void
     */
    public static function header(string $pageTitle): void
    {
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
