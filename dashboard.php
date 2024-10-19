<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookHub Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h2>Book <span class="hub" style="color:black;">hub</span></h2>
            <p>LMS</p>
        </div>
        <ul>
            <li><a href="#dashboard" class="btn">Dashboard</a></li>
            <li><a href="#books" class="btn">Books</a></li>
            <li><a href="#about" class="btn">About us</a></li>
            <li><a href="logout.php" class="btn"><strong>LOGOUT</strong></a></li>
        </ul>
    </div>
    <div class="main-content">

    <?
    print_r($_SESSION);
    ?>
    </div>
</body>
</html>

