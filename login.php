<?php

require "vendor/autoload.php";
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

// Include Google Cloud dependencies using Composer
use Google\Cloud\RecaptchaEnterprise\V1\RecaptchaEnterpriseServiceClient;
use Google\Cloud\RecaptchaEnterprise\V1\Event;
use Google\Cloud\RecaptchaEnterprise\V1\Assessment;
use Google\Cloud\RecaptchaEnterprise\V1\TokenProperties\InvalidReason;

/**
  * Create an assessment to analyze the risk of a UI action.
  * @param string $recaptchaKey The reCAPTCHA key associated with the site/app
  * @param string $token The generated token obtained from the client.
  * @param string $project Your Google Cloud Project ID.
  * @param string $action Action name corresponding to the token.
  */
function create_assessment(
  string $recaptchaKey,
  string $token,
  string $project,
  string $action
): void {
  // Create the reCAPTCHA client.
  // TODO: Cache the client generation code (recommended) or call client.close() before exiting the method.
  $client = new RecaptchaEnterpriseServiceClient();
  $projectName = $client->projectName($project);

  // Set the properties of the event to be tracked.
  $event = (new Event())
    ->setSiteKey($recaptchaKey)
    ->setToken($token);

  // Build the assessment request.
  $assessment = (new Assessment())
    ->setEvent($event);

  try {
    $response = $client->createAssessment(
      $projectName,
      $assessment
    );

    // Check if the token is valid.
    if ($response->getTokenProperties()->getValid() == false) {
      printf('The CreateAssessment() call failed because the token was invalid for the following reason: ');
      printf(InvalidReason::name($response->getTokenProperties()->getInvalidReason()));
      return;
    }

    // Check if the expected action was executed.
    if ($response->getTokenProperties()->getAction() == $action) {
      // Get the risk score and the reason(s).
      // For more information on interpreting the assessment, see:
      // https://cloud.google.com/recaptcha-enterprise/docs/interpret-assessment
      printf('The score for the protection action is:');
      printf($response->getRiskAnalysis()->getScore());
    } else {
      printf('The action attribute in your reCAPTCHA tag does not match the action you are expecting to score');
    }
  } catch (exception $e) {
    printf('CreateAssessment() call failed with the following error: ');
    printf($e);
  }
}

// TODO: Replace the token and reCAPTCHA action variables before running the sample.
create_assessment(
   '6LcdymMqAAAAAOmOD6rluPMUyycgvaY1Z1PsxMbv',
   'YOUR_USER_RESPONSE_TOKEN',
   'project-1-268307',
   'YOUR_RECAPTCHA_ACTION'
);


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
