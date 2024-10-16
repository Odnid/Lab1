<?php
$stored_answer = 'user_answer'; // Retrieve from the database
if ($_POST['security_answer'] === $stored_answer) {
    // Proceed with login
} else {
    die("Security answer incorrect.");
}
?>
