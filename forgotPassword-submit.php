<?php

require('inc/config.php');
session_start();

$email = $_POST['email'];

$sql = "SELECT password FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);
$message = "";

if ($count == 1) {
    $to_email = $email;
    $subject = 'Forgot Password';
    $headers = 'From: serg.gnex@gmail.com';
    $message = "Your password is " . $row['password'] . " Please login at http://aflmw.test/mylogin.php";
    mail($to_email, $subject, $message, $headers);
    header("location: mylogin.php");
} else {
    $message = urlencode("error");
    header("Location: forgotPassword.php?message=" . $message);
}
