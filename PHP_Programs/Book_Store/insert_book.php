<?php
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

// Get the bookstore user's ID from the session (assuming you've stored it during login)
$bookstore_user_id = $_SESSION["user_id"];

// Handle form submission to insert a new book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // Insert book details into the database along with the user ID
    $insert_sql = "INSERT INTO books (title, author, description, price, bookstore_user_id) VALUES ('$title', '$author', '$description', '$price', '$bookstore_user_id')";

    if ($conn->query($insert_sql) === TRUE) {
        // Redirect to a success page or back to the catalogue
        header("Location: catalogue.php");
        exit();
    } else {
        // Handle insertion error (you can add more error handling)
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .centered-text {
            text-align: center;
            margin-top: 40px; /* Add some top margin for spacing */
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

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insert Book</h2>
        <form method="post" action="insert_book.php">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br>
            <label for="author">Author:</label>
            <input type="text" name="author" required><br>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea><br>
            <label for="price">Price:</label>
            <input type="text" name="price" required><br>
            <input type="submit" value="Insert Book">
        </form>
        <div class="centered-text">
        <p>Return to Profile <a href="profile.php">Profile</a></p>
    </div>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
