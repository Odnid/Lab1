<?php


session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // Use your MySQL password
$dbname = "user_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values
    $username = $_POST['username'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];

    // Query to get user details
    $sql = "SELECT id, password_hash, otp_secret, failed_attempts, lockout_time FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $password_hash = $row['password_hash'];
        $otp_secret = $row['otp_secret'];
        $failed_attempts = $row['failed_attempts'];
        $lockout_time = $row['lockout_time'];
        $user_id = $row['id'];

        // Check if the account is locked out
        if ($failed_attempts >= 5 && (time() - strtotime($lockout_time)) < 900) {
            die("Account locked. Try again later.");
        }

        // Verify password
        if (password_verify($password, $password_hash)) {
            // Verify OTP
            require 'vendor/autoload.php';
            $g = new \PHPGangsta_GoogleAuthenticator();
            if ($g->verifyCode($otp_secret, $otp, 2)) {
                // Reset failed attempts and lockout time
                $sql_reset = "UPDATE users SET failed_attempts = 0, lockout_time = NULL WHERE id = $user_id";
                $conn->query($sql_reset);

                echo "Login successful!";
                // Optionally redirect to dashboard or homepage
                header('Location: dashboard.php');
                exit;
            } else {
                echo "Invalid OTP.";
            }
        } else {
            // Increment failed login attempts
            $sql_update_attempts = "UPDATE users SET failed_attempts = failed_attempts + 1, lockout_time = NOW() WHERE username = '$username'";
            $conn->query($sql_update_attempts);
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}

$conn->close();
?>
