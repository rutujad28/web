<?php
// Get the student's roll number from the URL
if (isset($_GET['roll_number'])) {
    $student_roll_number = $_GET['roll_number'];

    // Connect to the database (replace with your database credentials)
    $conn = mysqli_connect("localhost", "root", "Rutu@2810", "vit_results");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the student's results from the database
    $query = "SELECT * FROM results WHERE roll_number = '$student_roll_number'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Create a text file
        $file_name = "student_result_$student_roll_number.txt";
        $file_content = "Results for Roll Number: $student_roll_number\n\n";

        while ($row = mysqli_fetch_assoc($result)) {
            $subject_name = $row['subject_name'];
            $mse_marks = $row['mse_marks'];
            $ese_marks = $row['ese_marks'];
            $total_marks = $row['total_marks'];

            $file_content .= "Subject: $subject_name\n";
            $file_content .= "MSE Marks: $mse_marks\n";
            $file_content .= "ESE Marks: $ese_marks\n";
            $file_content .= "Total Marks: $total_marks\n\n";
        }

        // Set the HTTP response headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($file_content));

        // Output the file content for download
        echo $file_content;

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "No results found for Roll Number: $student_roll_number";
    }
} else {
    echo "Roll Number not provided.";
}
?>
