<?php
// Start a session for authentication if needed
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    // If not authenticated, redirect to the login page
    header("Location: login.php");
    exit();
}

// Include your database connection code here
// Replace these placeholders with your actual database credentials
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

// Get the book ID from the URL parameter
if (isset($_GET["book_id"])) {
    $book_id = $_GET["book_id"];
} else {
    // Redirect to the catalog page if no book ID is provided
    header("Location: catalogue.php");
    exit();
}

// Fetch the book details from the database based on the book ID
$fetch_book_sql = "SELECT * FROM books WHERE id = '$book_id'";
$fetch_book_result = $conn->query($fetch_book_sql);

if ($fetch_book_result->num_rows == 0) {
    // Redirect to the catalog page if the book ID does not exist
    header("Location: catalogue.php");
    exit();
}

// Process form submission if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated book details from the form
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Update the book details in the database
    $update_sql = "UPDATE books SET title = '$title', author = '$author', description = '$description', price = '$price' WHERE id = '$book_id'";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect to the catalog page after successful update
        header("Location: catalogue.php");
        exit();
    } else {
        // Handle update error
        echo "Error updating book: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <style>
        
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h2 {
    color: #333;
}

form {
    text-align: left;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #555;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Book</h2>
        <form method="post" action="">
            <?php
            // Display the existing book details in the form for editing
            while ($row = $fetch_book_result->fetch_assoc()) {
                echo "<label for='title'>Title:</label>";
                echo "<input type='text' name='title' value='" . $row["title"] . "' required><br>";
                echo "<label for='author'>Author:</label>";
                echo "<input type='text' name='author' value='" . $row["author"] . "' required><br>";
                echo "<label for='description'>Description:</label>";
                echo "<textarea name='description'>" . $row["description"] . "</textarea><br>";
                echo "<label for='price'>Price:</label>";
                echo "<input type='text' name='price' value='" . $row["price"] . "' required><br>";
                echo "<input type='submit' value='Save'>";
            }
            ?>
        </form>
    </div>
</body>
</html>
