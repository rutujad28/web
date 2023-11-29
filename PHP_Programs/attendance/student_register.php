<?php
$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $prn = $_POST['prn'];
    $is_hosteller = $_POST['hosteller'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO students (name, prn, is_hosteller, password) VALUES ('$name', '$prn', '$is_hosteller', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Student registration successful!";
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
    <title>Student Registration</title>
</head>
<body>
    <div class="container">
        <h2>Student Registration</h2>
        <form action="" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            
            <label for="prn">PRN:</label>
            <input type="text" name="prn" required>
            
            <label for="hosteller">Hosteller:</label>
            <select name="hosteller">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
