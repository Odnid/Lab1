<?php
session_start();

include "conn.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Query to get user details
    $sql = "SELECT id, password_hash FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        $password_hash = $row['password_hash'];
        $user_id = $row['id'];

        // Check if the account is locked out
        if ($failed_attempts >= 5 && (time() - strtotime($lockout_time)) < 900) {
            die("Account locked. Try again later.");
        }

        // Verify password
        if (password_verify($password, $password_hash)); {
        
                echo "Login successful!";
                // Optionally redirect to dashboard or homepage
                header('Location: dashboard.php');
                exit;
         } else {
                echo "Invalid password.";
            
    } else {
        echo "User not found.";
    }
    }

$conn->close();
?>
