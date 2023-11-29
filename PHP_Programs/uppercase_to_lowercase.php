<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Text Converter</h2>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input and convert it to uppercase directly
        $inputString = strtoupper($_POST["inputString"]);

        // Capitalize the first character of each word
        $finalString = ucwords(strtolower($inputString));
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="inputString">Enter text:</label>
        <input type="text" id="inputString" name="inputString" required>
        <br>
        <input type="submit" value="Convert">
    </form>

    <?php
    // Display the result if available
    if (isset($finalString)) {
        echo "<p>Original String: " . htmlspecialchars($inputString) . "</p>";
        echo "<p>Processed String: " . htmlspecialchars($finalString) . "</p>";
    }
    ?>
</body>
</html>
