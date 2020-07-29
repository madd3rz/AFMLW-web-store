<?php

require('inc/config.php');
session_start();

$user_id = $_SESSION['id'];
$bank_name = $_POST['bank_name'];
$order_id = $_POST['order_id'];
$total = $_POST['total'];

$sql = "INSERT INTO purchase(product_id,quantity,user_id,order_id) SELECT product_id,quantity,concat('" . $user_id . "'),concat('" . $order_id . "') FROM cart WHERE user_id = '$user_id'";

$sql2 = "INSERT INTO payment(order_id,bank_name,total) VALUES ('$order_id','$bank_name','$total')";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if (!$result && !$result2) {
    $message = urlencode("errorAddPayment");
    header("Location: myPurchases.php?message=" . $message);
} else {
    $message = "";
    $to_email = $_SESSION['email'];
    $subject = 'AFLMW : Purchase Details';
    $headers = 'From: ADMIN AFLMW';

    $emailSQL =
        "SELECT c.*,p.model_name,p.price
        FROM cart c
        INNER JOIN product p on c.product_id = p.id
        WHERE c.user_id = '$user_id' 
        ORDER BY date_created";

    $resultEmail = mysqli_query($conn, $emailSQL);
    $purchases = mysqli_fetch_all($resultEmail, MYSQLI_ASSOC);

    foreach ($purchases as $key => $purchase) {
        $quantity = $purchase['quantity'];
        $product_id = $purchase['product_id'];
        $sqlRemoveStock = "UPDATE product SET stock = stock - '$quantity' WHERE id = '$product_id'";
        $resultRemoveStock = mysqli_query($conn, $sqlRemoveStock);
    }
    $counter = 0;
    $message .= "Your purchase details \n";
    foreach ($purchases as $key => $purchase) {
        $message .= "No : " . ++$counter . "\n";
        $message .= "Product Name : " . $purchase['model_name'] . "\n";
        $message .= "Product Price : " . $purchase['price'] . "\n";
        $message .= "Quantity : " . $purchase['quantity'] . "\n";
        $message .= "Date Added : " . $purchase['date_created'] . "\n";
    }

    $message .= "Total : RM" . $total . "\n";
    $message .= "To view more details, please visit http://aflmw.test/myPurchases.php";


    mail($to_email, $subject, $message, $headers);

    $sql3 = "DELETE FROM cart WHERE user_id = '$user_id'";
    $result3 = mysqli_query($conn, $sql3);
    $message = urlencode("successAddPayment");
    header("Location: myPurchases.php?message=" . $message);
}
