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

// Get the user ID from the session
$user_id = $_SESSION["user_id"];

// Fetch the sold books for the specific user from the "sold_books" table
$sold_books_sql = "SELECT * FROM sold_books WHERE bookstore_user_id = '$user_id'";
$sold_books_result = $conn->query($sold_books_sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sold Books</title>
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

        .centered-text {
            text-align: center;
            margin-top: 40px; /* Add some top margin for spacing */
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
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
        <h2>Sold Books</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Sale Date and Time</th>
            </tr>
            <?php
            if ($sold_books_result->num_rows > 0) {
            // Display the list of sold books
            while ($row = $sold_books_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["customer_name"] . "</td>";
                echo "<td>" . $row["customer_mobile"] . "</td>";
                echo "<td>" . $row["sale_date"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Books are not Sold.</td></tr>";
        }
            ?>
        </table>
        <div class="centered-text">
        <p>Return to Profile <a href="profile.php">Profile</a></p>
    </div>
    </div>
</body>
</html>
