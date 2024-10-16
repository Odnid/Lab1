<?php
session_start();
$max_attempts = 5;
$lockout_time = 900; // 15 minutes in seconds

if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= $max_attempts) {
    $time_diff = time() - $_SESSION['last_attempt_time'];
    if ($time_diff < $lockout_time) {
        die("Account locked. Try again in " . (15 - floor($time_diff / 60)) . " minutes.");
    } else {
        $_SESSION['failed_attempts'] = 0; // Reset after lockout time
    }
}

if ($_POST['password'] == $correct_password) {
    // Reset failed attempts
    $_SESSION['failed_attempts'] = 0;
    // Process login
} else {
    $_SESSION['failed_attempts']++;
    $_SESSION['last_attempt_time'] = time();
    die("Invalid credentials. Attempt " . $_SESSION['failed_attempts'] . " of $max_attempts.");
}
?>
