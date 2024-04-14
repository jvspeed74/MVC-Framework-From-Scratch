<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: View.php
 * Description:
 */


abstract class View {
    
    /**
     * Outputs the HTML header for the webpage.
     *
     * This method outputs the standard HTML header including the doctype declaration,
     * meta tags, and title tag. It also includes some basic CSS styling.
     *
     * @return void
     */
    static public function header(): void {
        ?>
        <!DOCTYPE html>
        <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sample Homepage</title>
        <style>
            /* Some basic CSS for styling */
            .product {
                border: 1px solid #ccc;
                margin-bottom: 20px;
                padding: 10px;
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

