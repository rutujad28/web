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

// Check if a book with the given ID exists
if ($fetch_book_result->num_rows == 0) {
    // Redirect to the catalog page with an error message
    $_SESSION["error_message"] = "Book not found.";
    header("Location: catalogue.php");
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get customer details from the form
    $title = $conn->real_escape_string($_POST["title"]);
    $author = $conn->real_escape_string($_POST["author"]);
    $price = floatval($_POST["price"]);
    $customer_name = $conn->real_escape_string($_POST["customer_name"]);
    $customer_mobile = $conn->real_escape_string($_POST["customer_mobile"]);
    $sale_date = date("Y-m-d H:i:s"); // Get the current date and time

    // Insert the sold book details into the "sold_books" table
    $insert_sale_sql = "INSERT INTO sold_books (bookstore_user_id, title, author, price, customer_name, customer_mobile, sale_date) 
                        VALUES ('$user_id', '$title', '$author', '$price', '$customer_name', '$customer_mobile', '$sale_date')";

    if ($conn->query($insert_sale_sql) === TRUE) {
        // Delete the book from the catalog for the specific user
        $delete_book_sql = "DELETE FROM books WHERE id = '$book_id' AND bookstore_user_id = '$user_id'";
        if ($conn->query($delete_book_sql) === TRUE) {
            // Redirect to the catalog page after successful sale
            header("Location: catalogue.php");
            exit();
        } else {
            // Handle delete error
            $_SESSION["error_message"] = "Error deleting book from catalog: " . $conn->error;
            header("Location: catalogue.php");
            exit();
        }
    } else {
        // Handle insert error
        $_SESSION["error_message"] = "Error selling book: " . $conn->error;
        header("Location: catalogue.php");
        exit();
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sell Book</title>
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
        <h2>Sell Book</h2>
        <form method="post" action="">
            <?php
            // Display the existing book details
            while ($row = $fetch_book_result->fetch_assoc()) {
                echo "<label for='title'>Title:</label>";
                echo "<input type='text' name='title' value='" . htmlspecialchars($row["title"]) . "' readonly><br>";
                echo "<label for='author'>Author:</label>";
                echo "<input type='text' name='author' value='" . htmlspecialchars($row["author"]) . "' readonly><br>";
                echo "<label for='description'>Description:</label>";
                echo "<textarea name='description' readonly>" . htmlspecialchars($row["description"]) . "</textarea><br>";
                echo "<label for='price'>Price:</label>";
                echo "<input type='text' name='price' value='" . $row["price"] . "' readonly><br>";
                echo "<label for='customer_name'>Customer Name:</label>";
                echo "<input type='text' name='customer_name' required><br>";
                echo "<label for='customer_mobile'>Customer Mobile:</label>";
                echo "<input type='text' name='customer_mobile' required><br>";
                echo "<input type='submit' value='Sell'>";
            }
            ?>
        </form>
    </div>
</body>
</html>
