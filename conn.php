<?
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

?>
