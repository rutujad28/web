<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
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
        input[type="text"],
        input[type="number"] {
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
    </style>
    <script>
        function showSuccessMessage() {
            alert("Marks are added successfully!"); // Show an alert message
        }
    </script>
</head>
<body>
    <h1>Admin Page</h1>
    <form action="process.php" method="POST">
        <label for="roll_number">Enter 8-digit Roll Number:</label>
        <input type="text" name="roll_number" id="roll_number" required>
        <br><br>
        <h2> Fill marks out of 100 </h2>
        <br><br>
        <label for="subject1_mse">Web Technology - MSE Marks:</label>
        <input type="number" name="subject1_mse" id="subject1_mse" required>
        <label for="subject1_ese">ESE Marks:</label>
        <input type="number" name="subject1_ese" id="subject1_ese" required>
        <br><br>
        <label for="subject2_mse">Design and Analysis of Algorithms - MSE Marks:</label>
        <input type="number" name="subject2_mse" id="subject2_mse" required>
        <label for="subject2_ese">ESE Marks:</label>
        <input type="number" name="subject2_ese" id="subject2_ese" required>
        <br><br>
        <label for="subject3_mse">Computer Networks - MSE Marks:</label>
        <input type="number" name="subject3_mse" id="subject3_mse" required>
        <label for="subject3_ese">ESE Marks:</label>
        <input type="number" name="subject3_ese" id="subject3_ese" required>
        <br><br>
        <label for="subject4_mse">Software Design and Modelling - MSE Marks:</label>
        <input type="number" name="subject4_mse" id="subject4_mse" required>
        <label for="subject4_ese">ESE Marks:</label>
        <input type="number" name="subject4_ese" id="subject4_ese" required>
        <br><br>
        <input type="submit" name="calculate" value="Calculate Result" onclick="showSuccessMessage()">
    </form>
</body>
</html>
