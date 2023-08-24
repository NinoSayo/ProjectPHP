<?php
session_start();
include("../Database/Connect.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $orderID = mysqli_real_escape_string($con, $_POST['orderID']);

    // Update the order status to 'Canceled'
    $sql = "UPDATE orders SET order_status = '4' WHERE order_id = '$orderID'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $sql = "SELECT * FROM order_items WHERE order_id = '$orderID'";
        $ItemQTY = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($ItemQTY)) {
            $prodID = $row['product_id'];
            $item_qty = $row['item_qty'];

            $sql1 = "SELECT product_quantity FROM product where product_id = '$prodID'";
            $currentQTY = mysqli_query($con, $sql1);

            if ($currentQTY) {
                $currentStock = mysqli_fetch_assoc($currentQTY)['product_quantity'];

                $newStock = $currentStock + $item_qty;

                $sql2 = "UPDATE product set product_quantity = '$newStock' WHERE product_id = '$prodID'";
                mysqli_query($con, $sql2);
            } else {
                // Handle error if query fails
                echo 'error';
                exit;
            }
        }
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
