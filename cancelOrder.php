<?php
include("Functions/userFunction.php");
include("Functions/redirect.php");

if(isset($_POST['cancel_order'])) {
    $orderID = $_POST['order_id'];

    // Update the order status to 'Cancelled' in the database
    $updateStatusQuery = "UPDATE orders SET order_status = '4' WHERE order_id = '$orderID'";
    $updateStatusResult = mysqli_query($con, $updateStatusQuery);

    if ($updateStatusResult) {
        // Redirect or display a success message
        redirect("myOrder.php","Cancel successful"); // Redirect to the order list page, adjust the URL as needed
    } else {
        // Handle the case where the update failed
        echo "Failed to cancel the order.";
    }
}
?>