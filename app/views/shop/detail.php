<?php
/*
File: detail.php
Created By: diffi
Date: 4/4/2024
Description: 
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <style>
        /* Some basic CSS for styling */
        .product {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 10px;
        }
    </style>
</head>
<body>
<h1>Product Details</h1>
<div class="products">
    <?php
    // Check if products array is not empty
    if (!empty($data)) {
        // Loop through each product
        foreach ($data as $d) {
            // Output the product details with a link to the product details page
            echo '<div class="product">';
            echo '<h2>' . htmlspecialchars($d['Name']) . '</h2>';
            echo '<p>ID: ' . htmlspecialchars($d['ID']) . '</p>';
            echo '<p>Price: $' . number_format($d['Price'], 2) . '</p>';
            echo '<p>Description: ' . htmlspecialchars($d['Description']) . '</p>';
            echo '</div>';
        }
    } else {
        // No products found
        echo '<p>This product does not exist.</p>';
    }
    ?>
</div>
</body>
</html>

