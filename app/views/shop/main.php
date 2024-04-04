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
<h1>Shop</h1>
<div class="products">
    <?php
    // Check if products array is not empty
    if (!empty($data)) {
        // Loop through each product
        foreach ($data as $d) {
            // Output the product details with a link to the product details page
            echo '<div class="product">';
            echo '<h2><a href="detail/' . $d['ID'] . '">' . htmlspecialchars($d['Name']) . '</a></h2>';
            echo '<p>Price: $' . number_format($d['Price'], 2) . '</p>';
            echo '</div>';
        }
    } else {
        // No products found
        echo '<p>No products found.</p>';
    }
    ?>
</div>
</body>
</html>
