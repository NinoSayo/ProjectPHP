<?php
session_start();
include("../Functions/myFunction.php");
include("../Middleware/admin.php");

if (isset($_POST['order_id'])) {
    $orderID = mysqli_real_escape_string($con, $_POST['order_id']);

    // Delete order items
    $deleteOrderItemsQuery = "DELETE FROM order_items WHERE order_id = '$orderID'";
    $deleteOrderItemsResult = mysqli_query($con, $deleteOrderItemsQuery);

    // Delete order
    if ($deleteOrderItemsResult) {
        $deleteOrderQuery = "DELETE FROM orders WHERE order_id = '$orderID'";
        $deleteOrderResult = mysqli_query($con, $deleteOrderQuery);

        if ($deleteOrderResult) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>