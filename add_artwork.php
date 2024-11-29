<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $price = $_POST['price'];

    
    $imagePath = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

   
    $query = "INSERT INTO artworks (title, description, price, image_path) VALUES (:title, :description, :price, :image_path)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $imagePath);
    if ($stmt->execute()) {
        echo "Artwork added successfully!";
    } else {
        echo "Error adding artwork.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Artwork</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="add-artwork-form">
    <h2>Add New Artwork</h2>
    <form action="add_artwork.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Artwork</button>
    </form>
</div>

</body>
</html>
