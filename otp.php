<?php
require 'vendor/autoload.php';

$g = new \PHPGangsta_GoogleAuthenticator();
$secret = 'YOUR_SECRET_KEY'; // Generate a new secret per user

$otp = $_POST['otp'];

if ($g->verifyCode($secret, $otp, 2)) {
    echo 'OTP is correct!';
} else {
    echo 'Invalid OTP.';
}
?>
