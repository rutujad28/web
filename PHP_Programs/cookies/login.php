<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            if ($row["session_count"] < 3) {
                $_SESSION["username"] = $username;
                $row["session_count"]++;
                $updateSql = "UPDATE users SET session_count = " . $row["session_count"] . " WHERE id=" . $row["id"];
                $conn->query($updateSql);
                header("Location: dashboard.php");
            } else {
                echo "Maximum limit of concurrent sessions has been achieved.";
            }
        } else {
            echo "Incorrect password. <a href='login.php'>Try again</a>.";
        }
    } else {
        echo "User not found. <a href='register.php'>Register here</a>.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .registration-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin: 8px 0;
            color: #333;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin: 8px 0 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="registration-container">
    <h2>User Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <p>If not have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>
</html>
