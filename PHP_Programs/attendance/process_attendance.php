<?php
session_start();

$teacher_id = isset($_SESSION['teacher_id']) ? $_SESSION['teacher_id'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'attendance_date' is set in the POST data
    if (isset($_POST['attendance_date'])) {
        // Get the selected date from the form
        $raw_date = $_POST['attendance_date'];

        // Debugging: Display the raw date to check if it's received correctly
        echo "Raw Date: " . $raw_date . "<br>";

        // Format the date as 'ddmmyyyy' for MySQL
        $formatted_date = date("dmY", strtotime($raw_date));

        // Debugging: Display the formatted date
        echo "Formatted Date: " . $formatted_date . "<br>";

        // Check if 'students' is set in the POST data
        if (isset($_POST['students'])) {
            // Get the array of selected student IDs
            $selected_students = $_POST['students'];

            // Connect to the database
            $conn = new mysqli("localhost", "root", "Rutu@2810", "attendance_system");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Insert attendance records into the database
            foreach ($selected_students as $student_id) {
                // Validate and sanitize the input values
                $student_id = intval($student_id);
                $teacher_id = intval($teacher_id);

                // You might want to check if the attendance record for the selected date already exists for each student
                // If it does, you can update the existing record instead of inserting a new one
                $sql = "INSERT INTO attendance (student_id, teacher_id, attendance_date, is_present) 
                        VALUES ('$student_id', '$teacher_id', '$formatted_date', '1')";
                $result = $conn->query($sql);

                if (!$result) {
                    echo "Error: " . $conn->error;
                }
            }

            $conn->close();

            // Redirect back to the teacher dashboard or any other page
            header("Location: teacher_dashboard.php");
            exit();
        } else {
            echo "No students selected!";
        }
    } else {
        echo "Attendance date not set!";
    }
} else {
    // Handle cases where the form was not submitted via POST
    echo "Invalid request!";
}
?>
