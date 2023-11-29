<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "Rutu@2810", "complaint_system");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $prn = $_POST['prn'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO students (email, password, prn) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $prn);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_close($conn);
        header("Location: student_login.php");
        exit();
    } else {
        // Registration failed
        echo "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint System - Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2>
        <form action="student_register.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="prn">PRN (8 digits):</label>
            <input type="text" name="prn" pattern="\d{8}" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
