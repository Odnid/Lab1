<?php
<<<<<<< HEAD
=======

// Connect to the database
$servername = "localhost";
$username = "root";
$password = ""; // Use your MySQL password
$dbname = "user_management_system";
>>>>>>> 64f3ae2135781bd6a40ad03d9f77ee4ecef6a5e2

include "conn.php";



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

<<<<<<< HEAD

    // Insert the data into the `users` table
    $sql = "INSERT INTO users (username, email, password_hash, security_question, security_answer_hash)
            VALUES ('$username', '$email', '$password_hash', '$security_question', '$security_answer_hash')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully. You can now log in.";
        // Optionally redirect to login page
        header('Location: index.html');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
=======
>>>>>>> 64f3ae2135781bd6a40ad03d9f77ee4ecef6a5e2
}


$conn->close();
?>
