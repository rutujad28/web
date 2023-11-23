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

// Get the bookstore user's ID from the session (assuming you've stored it during login)
$bookstore_user_id = $_SESSION["user_id"];

// Fetch books from the database
// Query the books table to retrieve books for the logged-in user
$catalogue_sql = "SELECT * FROM books WHERE bookstore_user_id = '$bookstore_user_id'";
$catalogue_result = $conn->query($catalogue_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Catalogue</title>
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

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h2>Book Catalogue</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        if ($catalogue_result->num_rows > 0) {
            while ($row = $catalogue_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>$" . $row["price"] . "</td>";
                echo "<td>";
                // Add "Edit" link/button here
                echo "<a href='edit_book.php?book_id=" . $row["id"] . "'>Edit</a> | ";
                // Add "Sell" link/button here
                echo "<a href='sell_book.php?book_id=" . $row["id"] . "'>Sell</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Books are not Available.</td></tr>";
        }
        ?>
    </table>
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
