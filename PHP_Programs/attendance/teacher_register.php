<?php
$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $employee_id = $_POST['employee_id'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO teachers (name, employee_id, password) VALUES ('$name', '$employee_id', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Teacher registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Teacher Registration</title>
</head>
<body>
    <div class="container">
        <h2>Teacher Registration</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            
            <label for="employee_id">Employee ID:</label>
            <input type="text" name="employee_id" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
