<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint System - Submit Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Submit Complaint</h2>
        <form action="submit_complaint.php" method="post">
            <label for="complaint">Complaint:</label>
            <textarea name="complaint" rows="4" required></textarea>

            <button type="submit">Submit Complaint</button>
        </form>
    </div>
</body>
</html>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['email'])) {
    $conn = mysqli_connect("localhost", "root", "Rutu@2810", "complaint_system");

    $email = $_SESSION['email'];
    $complaint = $_POST['complaint'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT prn FROM students WHERE email=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $prn = $row['prn'];

        $insertQuery = "INSERT INTO complaints (prn, complaint_text) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ss", $prn, $complaint);
        mysqli_stmt_execute($stmt);

        mysqli_close($conn);

        header("Location: complaint_submitted.php"); // Redirect to a different page after submission
        exit();
    } else {
        // Handle the case where the user doesn't exist
    }
} else {
    header("Location: student_login.php");
    exit();
}
?>
