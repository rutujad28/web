<?php
// Start the session
session_start();

// Assume a session has already started after successful login
// Sample code to retrieve student information from the session
$student_id = isset($_SESSION['student_id']) ? $_SESSION['student_id'] : null;
$student_name = isset($_SESSION['student_name']) ? $_SESSION['student_name'] : null;

// Connect to the database and retrieve student-specific information
$conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM attendance WHERE student_id = $student_id";
$result = $conn->query($sql);

// Fetch and display attendance records
$attendanceRecords = [];
while ($row = $result->fetch_assoc()) {
    $attendanceRecords[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Dashboard</title>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $student_name; ?> (Student ID: <?php echo $student_id; ?>)!</h2>
        <h3>Attendance Records</h3>
        <?php if (empty($attendanceRecords)) : ?>
            <p>No attendance records available.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Present</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($attendanceRecords as $record) : ?>
                        <tr>
                            <td><?php echo $record['attendance_date']; ?></td>
                            <td><?php echo $record['is_present'] ? 'Yes' : 'No'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
