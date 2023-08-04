<?php
session_start();
include("../Database/Connect.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $orderID = mysqli_real_escape_string($con, $_POST['orderID']);

    // Update the order status to 'Canceled'
    $sql = "UPDATE orders SET order_status = '4' WHERE order_id = '$orderID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
    
} else {
    echo 'error';
}




?>