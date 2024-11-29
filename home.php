<?php
// home.php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}

// Include database connection file
require_once 'db.php';

// Fetch artworks from the database
$query = "SELECT * FROM artworks";
$stmt = $pdo->prepare($query);
$stmt->execute();
$artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Art Gallery</title>
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
            <h1>Welcome to the Online Art Gallery</h1>
            <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
        </header>

        <!-- Art Gallery Section -->
        <div class="gallery-container">
            <h1>Browse Artworks</h1>

            <!-- Display Artworks -->
            <div class="artworks-gallery" id="artworks-gallery">
                <?php if (empty($artworks)) { ?>
                    <!-- Sample Artwork Data -->
                    <div class="artwork-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLEcCaHpITnl5DUQkWhgRDooXxRRA8nsarzA&s" alt="Sunset View">
                        <h3>Sunset View</h3>
                        <p><strong>Artist:</strong> Jane Doe</p>
                        <p><strong>Genre:</strong> Landscape</p>
                        <p><strong>Price:</strong> $500</p>
                        <p><strong>Description:</strong> A beautiful sunset over a mountain range.</p>
                        <a href="buy_artwork.php?id=1">Buy Now</a>
                    </div>

                    <div class="artwork-card">
                        <img src="https://i0.wp.com/images.metmuseum.org/CRDImages/as/original/DP130155.jpg?w=1290&ssl=1" alt="Abstract Dreams">
                        <h3>Abstract Dreams</h3>
                        <p><strong>Artist:</strong> John Smith</p>
                        <p><strong>Genre:</strong> Abstract</p>
                        <p><strong>Price:</strong> $700</p>
                        <p><strong>Description:</strong> An abstract piece representing the chaos of the mind.</p>
                        <a href="buy_artwork.php?id=2">Buy Now</a>
                    </div>

                    <div class="artwork-card">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfL_3PE_uPh-McTkCA6xcxdsX45uT3u7apsQ&s" alt="Portrait of a Lady">
                        <h3>Portrait of a Lady</h3>
                        <p><strong>Artist:</strong> Emily Clark</p>
                        <p><strong>Genre:</strong> Portrait</p>
                        <p><strong>Price:</strong> $450</p>
                        <p><strong>Description:</strong> A classic portrait capturing the elegance of a woman.</p>
                        <a href="buy_artwork.php?id=3">Buy Now</a>
                    </div>

                    <div class="artwork-card">
                        <img src="https://usaartnews.com/wp-content/uploads/kirill-rolando-cyril-rolando-i-ego-cifrovoe-iskusstvo-3.jpg" alt="City Lights">
                        <h3>City Lights</h3>
                        <p><strong>Artist:</strong> Michael Lee</p>
                        <p><strong>Genre:</strong> Urban</p>
                        <p><strong>Price:</strong> $650</p>
                        <p><strong>Description:</strong> A vibrant cityscape depicting the glowing lights of the city.</p>
                        <a href="buy_artwork.php?id=4">Buy Now</a>
                    </div>

                <?php } else { ?>
                    <!-- Dynamic Artwork Display (from database) -->
                    <?php foreach ($artworks as $artwork): ?>
                        <div class="artwork-card">
                            <img src="<?php echo $artwork['image_path']; ?>" alt="<?php echo $artwork['title']; ?>">
                            <h3><?php echo $artwork['title']; ?></h3>
                            <p><strong>Artist:</strong> <?php echo $artwork['artist']; ?></p>
                            <p><strong>Genre:</strong> <?php echo $artwork['genre']; ?></p>
                            <p><strong>Price:</strong> $<?php echo $artwork['price']; ?></p>
                            <p><strong>Description:</strong> <?php echo $artwork['description']; ?></p>
                            <a href="buy_artwork.php?id=<?php echo $artwork['id']; ?>">Buy Now</a>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
