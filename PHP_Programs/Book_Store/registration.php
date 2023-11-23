<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Register as a Bookstore</h2>
        <form method="post" action="registration_process.php">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="address">Bookstore Address:</label>
            <textarea name="address" required></textarea><br>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
