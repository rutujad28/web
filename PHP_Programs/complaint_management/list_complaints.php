<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint System - List of Complaints</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>List of Complaints</h2>
        <table>
            <tr>
                <th>PRN</th>
                <th>Complaint</th>
            </tr>
            <?php
            session_start();

            if (isset($_SESSION['email'])) {
                $conn = mysqli_connect("localhost", "root", "Rutu@2810", "complaint_system");
                $result = mysqli_query($conn, "SELECT prn, complaint_text FROM complaints");
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>{$row['prn']}</td><td>{$row['complaint_text']}</td></tr>";
                }

                mysqli_close($conn);
            } else {
                header("Location: student_login.php");
                exit();
            }
            ?>
        </table>
    </div>
</body>
</html>
