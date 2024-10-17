<?php

include "captcha.php";
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

}


$conn->close();
?>
