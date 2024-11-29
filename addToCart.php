<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['user_id'];
    $artId = $_POST['art_id'];

    $sql = "INSERT INTO cart (user_id, art_id) VALUES ('$userId', '$artId')";

    if ($conn->query($sql) === TRUE) {
        echo "Item added to cart";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
