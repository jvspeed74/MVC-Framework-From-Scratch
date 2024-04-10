<?php
/*
File: ErrorView.php
Created By: Jalen Vaughn
Date: 4/10/2024
Description: 
*/


class ErrorView extends View {
    static public function render(string $message): void {
        // HTML for error page
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f4f4f4;
                }

                .container {
                    max-width: 600px;
                    margin: 50px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                h1 {
                    color: #e74c3c;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h1>Error</h1>
            <p><?php echo $message; ?></p>
        </div>
        </body>
        </html>
        <?php
    }
}
