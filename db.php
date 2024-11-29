<?php
// Database credentials
$servername = "localhost"; // typically 'localhost' for XAMPP
$username = "root"; // default MySQL username in XAMPP
$password = ""; // default MySQL password is empty for XAMPP
$dbname = "sohan_01"; // replace with your actual database name

try {
    // Establish PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
