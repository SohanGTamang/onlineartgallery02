<?php
// artworks.php
header('Content-Type: application/json');

// Include database connection file
require_once 'db.php';

// Check if the database connection was successful
if ($pdo) {
    try {
        // Prepare and execute query to fetch all artworks
        $stmt = $pdo->prepare("SELECT * FROM artworks");
        $stmt->execute();
        $artworks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return artworks as JSON
        echo json_encode($artworks);
    } catch (Exception $e) {
        // If there is an error, return it as a JSON error
        echo json_encode(['error' => 'Error fetching data: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Database connection failed.']);
}
?>