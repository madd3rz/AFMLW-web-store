<?php

include('inc/config.php');
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: mylogin.php");
    die;
}

$user_id = $_SESSION['id'];
$new_email = $_POST['new_email'];
$c_password = $_POST['c_password'];

$sql = "SELECT * FROM user 
        WHERE id = '$user_id' AND 
        password = '$c_password'";
$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    $sql2 = "UPDATE user 
    SET email = '$new_email'
    WHERE id = '$user_id'";
    $result2 = mysqli_query($conn, $sql2);

    if (!$result2) {
        $message = urlencode("errorEditEmail");
        header("Location: changeUserSetting.php?message=" . $message);
    } else {
        $message = urlencode("successEditEmail");
        header("Location: changeUserSetting.php?message=" . $message);
    }
} else {
    $message = urlencode("wrongpass");
    header("Location: changeUserSetting.php?message=" . $message);
}
