<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["order_id"])) {
    // Include your database connection code here
    include("../Database/Connect.php");

    $orderID = mysqli_real_escape_string($con, $_POST['order_id']);

    $deleteOrderItemsQuery = "DELETE FROM order_items WHERE order_id = '$orderID'";
    $deleteOrderItemsResult = mysqli_query($con, $deleteOrderItemsQuery);

    if (!$deleteOrderItemsResult) {
        die("Error deleting order items: " . mysqli_error($con));
    }

    $deleteOrderQuery = "DELETE FROM orders WHERE order_id = '$orderID'";
    $deleteOrderResult = mysqli_query($con, $deleteOrderQuery);

    if ($deleteOrderResult) {
        echo "success";
    } else {
        echo "error";
    }

    mysqli_close($con);
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}
?>
