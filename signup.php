<?php
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
    // Get the form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $security_question = $_POST['security-question'];
    $security_answer = $_POST['security-answer'];

    // Hash the password and security answer
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $security_answer_hash = password_hash($security_answer, PASSWORD_DEFAULT);

    // Generate an OTP secret for Google Authenticator (Using PHPGangsta/GoogleAuthenticator)
    require 'vendor/autoload.php';
    $g = new \PHPGangsta_GoogleAuthenticator();
    $otp_secret = $g->createSecret(); // Create OTP secret

    // Insert the data into the `users` table
    $sql = "INSERT INTO users (username, email, password_hash, otp_secret, security_question, security_answer_hash)
            VALUES ('$username', '$email', '$password_hash', '$otp_secret', '$security_question', '$security_answer_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. You can now log in.";
        // Optionally redirect to login page
        header('Location: index.html');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
