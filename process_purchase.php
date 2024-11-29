<?php
// process_purchase.php

// Include the database connection file
require_once 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

// Check if the artwork ID and other purchase details are passed
if (isset($_POST['artwork_id']) && isset($_POST['quantity'])) {
    $artwork_id = $_POST['artwork_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id']; // Assuming user ID is stored in session
    $total_price = $_POST['total_price']; // Calculate total price from artwork price and quantity

    // Prepare the SQL query to insert the order
    $query = "INSERT INTO orders (user_id, artwork_id, quantity, total_price, status) 
              VALUES (:user_id, :artwork_id, :quantity, :total_price, 'pending')";
    $stmt = $pdo->prepare($query);

    // Bind parameters to the query
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':artwork_id', $artwork_id);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':total_price', $total_price);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to a confirmation page
        echo "Purchase successfully processed!";
        // You can redirect to a thank you page or display order details here
    } else {
        echo "Error: Unable to process your order.";
    }
} else {
    echo "Error: Missing artwork ID or quantity.";
}
?>
