<!DOCTYPE html>
<html>
<head>
    <title>View Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        form {
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>View Result</h1>
    <form action="view_result.php" method="POST">
        <label for="student_roll_number">Enter Your Roll Number:</label>
        <input type="text" name="student_roll_number" id="student_roll_number" required>
        <br><br>
        <input type="submit" name="view_result" value="View Result">
    </form>

    <?php
    if (isset($_POST['view_result'])) {
        // Get student's roll number
        $student_roll_number = $_POST['student_roll_number'];

        // Connect to the database (replace with your database credentials)
        $conn = mysqli_connect("localhost", "root", "Rutu@2810", "vit_results");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve the student's results from the database
        $query = "SELECT * FROM results WHERE roll_number = '$student_roll_number'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Display the results in a table
            echo "<h2>Results for Roll Number: $student_roll_number</h2>";
            echo "<table>";
            echo "<tr><th>Subject Name</th><th>MSE Marks</th><th>ESE Marks</th><th>Total Marks</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['mse_marks'] . "</td>";
                echo "<td>" . $row['ese_marks'] . "</td>";
                echo "<td>" . $row['total_marks'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No results found for Roll Number: $student_roll_number";
        }

        echo "<p><a href='download_result.php?roll_number=$student_roll_number'>Download Result</a></p>";

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
</body>
</html>
