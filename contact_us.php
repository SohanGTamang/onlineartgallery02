<?php
// contact_us.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Art Gallery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-links">
            <a href="home.php">Home</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="add_art.php">Add Art</a>
            <a href="logout.php">Log Out</a>
        </div>
    </nav>

    <header>
        <h1>Contact Us</h1>
        <p>We would love to hear from you!</p>
    </header>

    <div class="container">
        <div class="contact-form">
            <form action="submit_contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
