<?php
session_start();

$teacher_id = isset($_SESSION['teacher_id']) ? $_SESSION['teacher_id'] : null;
$teacher_name = isset($_SESSION['teacher_name']) ? $_SESSION['teacher_name'] : null;

$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Teacher Dashboard</title>
    <!-- Include a datepicker library, e.g., jQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        /* Add your CSS styles for the calendar and checkbox list here */
    </style>

    <script>
        $(function() {
            // Initialize the datepicker
            $("#datepicker").datepicker();

            // Add additional JavaScript for handling checkboxes or other interactions
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $teacher_name; ?>!</h2>
        
        <!-- Calendar to select date -->
        <!-- <label for="datepicker">Select Date:</label>
        <input type="text" id="datepicker" name="attendance_date" required> -->
        <form method="post" action="calendar.php">
        <label for="selected_date">Select Date:</label>
        <input type="date" name="selected_date" value="<?php echo $selectedDate; ?>">
    </form>

        
        <h3>Attendance Records</h3>
        
        <!-- List of all students with checkboxes -->
        <form action="process_attendance.php" method="post">
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Present</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student) : ?>
                        <tr>
                            <td><?php echo $student['name']; ?></td>
                            <td><input type="checkbox" name="students[]" value="<?php echo $student['id']; ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- Add a submit button to submit the form -->
            <input type="submit" value="Submit Attendance">
        </form>
    </div>
</body>
</html>
