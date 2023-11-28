<!-- employee.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
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

// Function to fetch employees
function fetchEmployees($conn) {
    $sql = "SELECT id, name, position, department FROM employees";
    $result = $conn->query($sql);

    $employees = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
    }
    return $employees;
}

// Add employee to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $position = $_POST["position"];
    $department = $_POST["department"];

    $sql = "INSERT INTO employees (name, position, department) VALUES ('$name', '$position', '$department')";

    if (mysqli_query($conn, $sql)) {
        echo "Employee added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<div class="container">
    <h2>Add Employee</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="position">Position:</label>
        <input type="text" name="position" required>

        <label for="department">Department:</label>
        <input type="text" name="department" required>

        <button type="submit">Add Employee</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $employees = fetchEmployees($conn);
            foreach ($employees as $employee) {
                echo "<tr>";
                echo "<td>" . $employee["id"] . "</td>";
                echo "<td>" . $employee["name"] . "</td>";
                echo "<td>" . $employee["position"] . "</td>";
                echo "<td>" . $employee["department"] . "</td>";
                 // Check if the "id" key exists in the $category array
        if (isset($employee["id"])) {
            echo '<a href="edit.php?id=' . $employee["id"] . '">Edit</a> | ';
            echo '<a href="delete.php?id=' . $employee["id"] . '">Delete</a>';
        } else {
            echo 'Edit | Delete';
        }
                // echo "<td>
                //         <button type='button' onclick='editEmployee(" . $employee["id"] . ")'>Edit</button>
                //         <button type='submit' form='deleteForm' name='deleteEmployee' value='" . $employee["id"] . "'>Delete</button>
                //       </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

   
</div>

</body>
</html>
