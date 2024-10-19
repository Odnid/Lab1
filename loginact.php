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
    $stmt = $conn->prepare("SELECT id, password_hash, security_answer_hash, security_question FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if a result was returned
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($user_id, $hashed_password, $hashed_squespass, $db_secquestion);
        $stmt->fetch();

        // Verify the security question, password, and the security answer
        if ($secquestion === $db_secquestion && password_verify($password, $hashed_password) && password_verify($squespass, $hashed_squespass)) {
            // Store user information in session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;

            header("Location: dashboard.php");
            exit();
        } else {
            echo 'Invalid password, security question, or security answer.';
            header("Refresh: 3; URL='login.html'"); 
        }
    } else {
        echo 'Username not found.';
        header("Refresh: 3; URL='login.html'");
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>
