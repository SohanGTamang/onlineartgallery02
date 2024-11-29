<?php
// login.php
session_start();

// Include database connection file
require_once 'db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username and password are correct
    $query = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    // Fetch the user data from the database
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user exists and the password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Start a session and store user information
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];

        // Redirect to home page
        header('Location: home.php');
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Art Gallery</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="background-container">
    <div class="overlay"></div>

    <div class="container">
        <h1>Welcome to Online Art Gallery</h1>

        <!-- Login Form -->
        <div class="login-signup-box">
            <div class="login-signup">
                <form id="login-form" action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Login</button>
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </form>
                
                <!-- Display error message if login fails -->
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="scripts.js"></script>
</body>
</html>
