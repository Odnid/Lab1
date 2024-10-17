<?php
include_once 'conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form values and sanitize input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $secquestion = $_POST['secquestion']; 
    $squespass = $_POST['squespass'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT password_hash, security_answer_hash, security_question FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a result was returned
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($hashed_password, $hashed_squespass, $db_secquestion);
        $stmt->fetch();

        // Verify the security question, password, and the security answer
        if ($secquestion === $db_secquestion && password_verify($password, $hashed_password) && password_verify($squespass, $hashed_squespass)) {
            header("Location: dashboard.html");
            exit();
        } else {
            echo 'Invalid password, security question, or security answer.';
            header("Refresh: 3; URL='login.html'"); 
        }
    } else {
        echo 'Username not found.';
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
