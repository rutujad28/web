<?php
$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM teachers WHERE employee_id = '$employee_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Teacher login successful!";
            // Redirect to teacher dashboard
            header("Location: teacher_dashboard.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Teacher not found!";
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
    <title>Teacher Login</title>
</head>
<body>
    <div class="container">
        <h2>Teacher Login</h2>
        <form action="" method="post">
            <label for="employee_id">Employee ID:</label>
            <input type="text" name="employee_id" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
