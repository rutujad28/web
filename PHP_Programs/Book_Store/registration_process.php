<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get input data from the registration form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // Check if the username is already taken
    $check_username_sql = "SELECT * FROM bookstore_users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        // Username is already taken; display an error message
        $_SESSION["registration_error"] = "Username is already taken. Please choose a different username.";
        header("Location: registration.php"); // Redirect back to the registration page
        exit();
    } else {
        // Insert the user's information into the database
        $insert_sql = "INSERT INTO bookstore_users (username, password, email, address) VALUES ('$username', '$password', '$email', '$address')";

        if ($conn->query($insert_sql) === TRUE) {
            // Registration successful; redirect to the login page
            header("Location: login.php");
            exit();
        } else {
            // Registration failed; display an error message
            $_SESSION["registration_error"] = "Registration failed. Please try again later.";
            header("Location: registration.php"); // Redirect back to the registration page
            exit();
        }
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form was not submitted, redirect to the registration page
    header("Location: registration.php");
    exit();
}
?>
