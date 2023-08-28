<?php
// Include your database connection or other necessary code
include("../Database/Connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    // Update the order status with the selected new status
    $sql = "UPDATE orders SET order_status = '$newStatus' WHERE order_id = '$orderID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
