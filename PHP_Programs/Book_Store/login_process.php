<?php
session_start();

// Database connection parameters
$host = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = "Rutu@2810"; // Change this to your database password
$database = "book_store"; // Change this to your database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input data from the login form
$username = $_POST["username"];
$password = $_POST["password"];

// Query the database to check if the user exists
$sql = "SELECT * FROM bookstore_users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Check if there's a matching user
if ($result->num_rows == 1) {
    // User is authenticated; set session variables
    $user = $result->fetch_assoc();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];

    // Redirect to the bookstore's catalogue page
    header("Location: profile.php");
    exit();
} else {
    // Authentication failed; display an error message
    $_SESSION["login_error"] = "Invalid username or password.";
    header("Location: login.php"); // Redirect back to the login page
    exit();
}

// Close the database connection
$conn->close();
?>

