<!-- delete.php -->

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

// Delete employee from the database
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM employees WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "Employee deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
