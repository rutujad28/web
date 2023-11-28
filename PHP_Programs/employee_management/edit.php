<!-- edit.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "Rutu@2810";
$database = "employee_management";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Update employee in the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $department = $_POST["department"];

    $sql = "UPDATE employees SET name='$name', position='$position', department='$department' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Employee updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Fetch employee data for editing
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM employees WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
}
?>

<div class="container">
    <h2>Edit Employee</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

        <label for="position">Position:</label>
        <input type="text" name="position" value="<?php echo $row['position']; ?>" required>

        <label for="department">Department:</label>
        <input type="text" name="department" value="<?php echo $row['department']; ?>" required>

        <button type="submit">Update Employee</button>
    </form>
</div>

</body>
</html>
