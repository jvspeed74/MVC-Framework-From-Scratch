// Wait for the HTML document to be fully loaded before executing
document.addEventListener('DOMContentLoaded', function () {
    // Select all buttons with the class 'update-cart' and add click event listeners
    const updateButtons = document.querySelectorAll('.update-cart');

    updateButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default button action
            const productId = this.dataset.productId; // Get the product ID stored in a data attribute
            const newQuantity = this.previousElementSibling.value; // Get the new quantity from the input field immediately preceding the button

            updateCartQuantity(productId, newQuantity); // Call function to update the cart
        });
    });

    // Function to send an AJAX request to update the cart quantity on the server
    function updateCartQuantity(productId, quantity) {
        fetch('/cart/update', {
            method: 'POST', // Use POST method to send data
            headers: {
                'Content-Type': 'application/json', // Set content type to JSON
            },
            body: JSON.stringify({ productId, quantity }) // Send product ID and new quantity as JSON
        })
            .then(response => response.json()) // Parse the JSON response from the server
            .then(data => {
                if (data.success) {
                    alert('Cart updated successfully!'); // Alert success message
                    // Update the total price displayed on the page, if successful
                    document.querySelector('#total-price').textContent = data.newTotal;
                } else {
                    alert('Failed to update cart.'); // Alert failure message if not successful
                }
            })
            .catch(error => console.error('Error updating cart:', error)); // Log any errors to the console
    }
});
