<?php
$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prn = $_POST['prn'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE prn = '$prn'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Start a session to store user information
            session_start();

            // Store relevant user information in the session
            $_SESSION['student_id'] = $row['id'];
            $_SESSION['student_name'] = $row['name'];

            // Redirect to student dashboard
            header("Location: student_dashboard.php");
            exit(); // Ensure that no code is executed after the header function
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Student not found!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Login</title>
</head>
<body>
    <div class="container">
        <h2>Student Login</h2>
        <form action="" method="post">
            <label for="prn">PRN:</label>
            <input type="text" name="prn" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
