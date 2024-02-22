<?php
// Load inventory data from a database or external source
$inventory = [
    '1' => 100, // Product ID 1 with quantity 100
    '2' => 50    // Product ID 2 with quantity 50
];

// Check if the required parameters are provided
if (isset($_GET['product_id']) && isset($_GET['quantity'])) {
    $productId = $_GET['product_id'];
    $quantity = $_GET['quantity'];

    // Validate product ID and quantity
    if (isset($inventory[$productId]) && is_numeric($quantity) && $quantity >= 0) {
        // Update the inventory quantity for the specified product
        $inventory[$productId] = $quantity;
        echo "Inventory updated successfully for Product ID $productId";
    } else {
        // Invalid product ID or quantity
        http_response_code(400); // Bad Request
        echo "Invalid product ID or quantity";
    }
} else {
    // Required parameters are missing
    http_response_code(400); // Bad Request
    echo "Missing parameters: product_id and quantity are required";
}

    /*
    
    */
?>
