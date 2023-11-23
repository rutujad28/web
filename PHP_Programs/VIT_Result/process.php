<?php
if (isset($_POST['calculate'])) {
    // Get form data and perform calculations
    $roll_number = $_POST['roll_number'];
    $subject1_mse = $_POST['subject1_mse'];
    $subject1_ese = $_POST['subject1_ese'];

    $subject2_mse = $_POST['subject2_mse'];
    $subject2_ese = $_POST['subject2_ese'];

    $subject3_mse = $_POST['subject3_mse'];
    $subject3_ese = $_POST['subject3_ese'];

    $subject4_mse = $_POST['subject4_mse'];
    $subject4_ese = $_POST['subject4_ese'];

    // Calculate total marks for each subject
    $total_marks1 = ($subject1_mse * 0.3) + ($subject1_ese * 0.7);
    $total_marks2 = ($subject2_mse * 0.3) + ($subject2_ese * 0.7);
    $total_marks3 = ($subject3_mse * 0.3) + ($subject3_ese * 0.7);
    $total_marks4 = ($subject4_mse * 0.3) + ($subject4_ese * 0.7);

    // Calculate the average total marks
    $total_mse_marks = ($subject1_mse + $subject2_mse + $subject3_mse + $subject4_mse) * 0.3 / 4;
    $total_ese_marks = ($subject1_ese + $subject2_ese + $subject3_ese + $subject4_ese) * 0.7 / 4;
    $total_marks = ($total_marks1 + $total_marks2 + $total_marks3 + $total_marks4) / 4;

    // Connect to the database (replace with your database credentials)
    $conn = mysqli_connect("localhost", "root", "Rutu@2810", "vit_results");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert the results into the database
    $query = "INSERT INTO results (roll_number, subject_name, mse_marks, ese_marks, total_marks) VALUES ";
    $query .= "('$roll_number', 'Web Technology', $subject1_mse, $subject1_ese, $total_marks1), ";
    $query .= "('$roll_number', 'Design and Analysis of Algorithms', $subject2_mse, $subject2_ese, $total_marks2), ";
    $query .= "('$roll_number', 'Computer Networks', $subject3_mse, $subject3_ese, $total_marks3), ";
    $query .= "('$roll_number', 'Software Design and Modelling', $subject4_mse, $subject4_ese, $total_marks4), ";
    $query .= "('$roll_number', 'Total', $total_mse_marks, $total_ese_marks, $total_marks)";

    if (mysqli_query($conn, $query)) {
        // Redirect back to the admin page or show a success message
        header("Location: admin.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
