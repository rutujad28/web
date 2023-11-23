<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    // If not authenticated, redirect to the login page
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
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

        h2 {
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        a.logout {
            color: #ff0000;
        }

        a.logout:hover {
            text-decoration: underline;
            color: #dd0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
        <p>What would you like to do?</p>
        <ul>
            <li><a href="catalogue.php">Catalogue</a></li>
            <li><a href="insert_book.php">Insert Book</a></li>
            <li><a href="sold_books.php">Sold Books</a></li>
        </ul>
        <p><a href="login.php">Logout</a></p>
    </div>
</body>
</html>
