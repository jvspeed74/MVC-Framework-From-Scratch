<?php
/**
 * Author: Jalen Vaughn
 * Date: 4/8/24
 * File: View.php
 * Description:
 */


abstract class View {
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
        <?php
    }
    
    static public function footer(): void {
        //todo add footer
    }
}
