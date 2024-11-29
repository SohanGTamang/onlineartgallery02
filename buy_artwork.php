<?php
// buy_artwork.php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

// Include database connection file
require_once 'db.php';

// Get the artwork ID from the URL
if (isset($_GET['id'])) {
    $artworkId = $_GET['id'];

    // Fetch the artwork details from the database using the artwork ID
    $query = "SELECT * FROM artworks WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $artworkId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the artwork data
    $artwork = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$artwork) {
        // If the artwork is not found, show an error message
        echo "Artwork not found!";
        exit();
    }
} else {
    echo "No artwork ID provided!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Artwork</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Sidebar (Navigation Bar) -->
    <div class="sidebar">
        <nav class="navbar">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <li><a href="add_artwork.php">Add Art</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <header>
            <h1>Buy Artwork</h1>
            <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        </header>

        <!-- Display Artwork -->
        <div class="artwork-details">
            <img src="<?php echo $artwork['image_path']; ?>" alt="<?php echo $artwork['title']; ?>" class="artwork-image">
            <h2><?php echo $artwork['title']; ?></h2>
            <p><strong>Artist:</strong> <?php echo $artwork['artist']; ?></p>
            <p><strong>Genre:</strong> <?php echo $artwork['genre']; ?></p>
            <p><strong>Price:</strong> $<?php echo $artwork['price']; ?></p>
            <p><strong>Description:</strong> <?php echo $artwork['description']; ?></p>

            <!-- Buy Now Form -->
            <form action="process_purchase.php" method="POST">
                <input type="hidden" name="artwork_id" value="<?php echo $artwork['id']; ?>">
                <input type="hidden" name="price" value="<?php echo $artwork['price']; ?>">
                <button type="submit">Buy Now</button>
            </form>
        </div>
    </div>

</body>
</html>
