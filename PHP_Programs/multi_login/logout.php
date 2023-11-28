<?php
session_start();
include("db.php");

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    
    // Decrement the session count
    $sql = "UPDATE users SET session_count = session_count - 1 WHERE username='$username'";
    $conn->query($sql);

    session_unset();
    session_destroy();
}

header("Location: login.php");
exit();
?>
