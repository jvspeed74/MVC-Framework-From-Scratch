<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: View.php
 * Description: Abstract class containing the foundation for the header and footer methods.
 */


abstract class View {
    
    /**
     * Outputs the HTML header for the webpage.
     *
     * This method outputs the standard HTML header including the doctype declaration,
     * meta tags, and title tag. It also includes some basic CSS styling.
     *
     * @param string $pageTitle The title to be displayed on the browser tab.
     * @return void
     */
    static public function header(string $pageTitle): void {
        ?>
        <!DOCTYPE html>
        <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitFlex: <?= $pageTitle ?></title>
        <style>
            .product-container {
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* Three columns of equal width */
                gap: 20px; /* Adjust the gap between products */
            }

            .product {
                border: 1px solid #ccc;
                padding: 10px;
            }

            .compact-product {
                border: 1px solid #ccc;
                padding: 10px;
                width: 300px; /* Adjust the width as needed */
                margin-bottom: 20px;
                display: inline-block; /* Allows elements to sit side-by-side */
            }

            /* CSS for form alignment */
            .form-group {
                margin-bottom: 20px;
            }

            .form-control {
                width: 100%;
                padding: 8px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            /* Optional: Style the submit button */
            .btn-primary {
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <form method="get" action="<?= BASE_URL ?>/product/search/">
        <input type="text" name="search-terms" placeholder="Search products by name"
               autocomplete="off"
               onkeyup="">
        <input type="submit" value="Go"/>
    </form>
        <?php
    }
    
    /**
     * Outputs the HTML footer for the webpage.
     *
     * This method is intended to be implemented to output the HTML footer
     * content for the webpage. It can be used to include scripts, closing
     * tags, or any other content needed for the footer.
     *
     * @return void
     */
    static public function footer(): void {
        //todo add footer
    }
}

