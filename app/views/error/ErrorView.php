<?php

/**
 * Class ErrorView
 *
 * Represents the view for displaying error messages.
 */
class ErrorView extends View {
    /**
     * Renders the error view.
     *
     * This method outputs the HTML content for displaying an error message.
     * It includes the error message within a styled container.
     *
     * @param string $message The error message to display.
     * @return void
     */
    public static function render(string $message): void {
        // HTML for error page
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Favicon-->
            <link rel="icon" type="image/x-icon" href="/I211-Team-Project/public/assets/favicon.ico"/>
            <title>FitFlex: <?= $message ?></title>
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
            <p><?php echo htmlspecialchars($message); ?></p>
            <p><a href="<?= BASE_URL ?>">Back to Home</a></p>
        </div>
        </body>
        </html>
        <?php
    }
}
