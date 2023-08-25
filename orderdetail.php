<?php

include("Functions/userFunction.php");
include("Functions/redirect.php");
include("Functions/authenticate.php");
include("Includes/header.php");

if (isset($_GET['id'])) {
    $orderNO = $_GET['id'];

    $result = CheckValid($orderNO);
    if (mysqli_num_rows($result) < 0) {
    }
} else {
?>
    <h4>Something went wrong</h4>
<?php
}
$data = mysqli_fetch_array($result);
?>

<link rel="stylesheet" href="Assets/CSS/cart.css">
<style>
    .form-control {
        margin-top: 31px;
    }
</style>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.php">Home</a></span> / <span>Order History</span></p>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <div class="title">
                    <div class="row">
                        <div class="col">
                            <h4>Delivery Details</h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">
                        <a href="myOrder.php"><i class="bi bi-arrow-left"> Back</i></a>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label>Order NO :</label>
                                        <?= $data['Order_NO'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label>Name:</label>
                                            <?= $data['shipping_firstname'] ?> <?= $data['shipping_lastname'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                    <label >Email:</label>
                                            <?= $data['shipping_email'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label>Phone:</label>
                                            <?= $data['shipping_phone'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label>Address:</label>
                                            <?= $data['shipping_address'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label>City:</label>
                                            <?= $data['shipping_city'] ?>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <label>Postal Code:</label>
                                            <?= $data['shipping_pin'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 summary">
                <h4><b>Order Details</b></h4>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $userID = $_SESSION['auth_user']['id'];
                        $orderDetail = "SELECT o.order_id as oid,o.Order_NO,o.user_id,oi.*,p.*,pi.image_source
                FROM orders o, order_items oi,product p,product_image pi
                WHERE o.user_id = '$userID' AND oi.order_id = o.order_id AND p.product_id = oi.product_id AND o.Order_NO = '$orderNO' AND pi.product_id = oi.product_id";
                        $orderRun = mysqli_query($con, $orderDetail);
                        $previousProductId = null;
                        if ($orderRun && mysqli_num_rows($orderRun) > 0) {
                            while ($items = mysqli_fetch_assoc($orderRun)) {
                                if ($items['product_id'] !== $previousProductId) {
                        ?>
                                    <tr>
                                        <td class="align-middle">
                                            <img src="Assets/<?= $items['image_source'] ?>" alt="">
                                            <?= $items['product_name'] ?>
                                        </td>
                                        <td class="align-middle">
                                            &dollar;<?= $items['item_price'] ?>
                                        </td>
                                        <td class="align-middle">
                                            x <?= $items['item_qty'] ?>
                                        </td>
                                    </tr>
                        <?php
                                    $previousProductId = $items['product_id']; // Update the previous product ID
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <hr>
                <h5>Total Price: <span class="float-end fw-bold">&dollar;<?= $data['total_price'] ?></span></h5>
                <label for="payment" class="my-1">Payment method</label>
                <div class="border p-1">
                    <?= strtoupper($data['payment_method']) ?>
                </div>
                <label for="status" class="my-1">Status</label>
                <div class="border p-1">
                    <span class="status-dot" style="background-color:
        <?= $data['order_status'] == '1' ? 'green' : ($data['order_status'] == '2' ? 'blue' : ($data['order_status'] == '3' ? 'purple' : ($data['order_status'] == '4' ? 'red' : ($data['order_status'] == '5' ? 'orange' : ($data['order_status'] == '6' ? 'yellow' : ($data['order_status'] == '7' ? 'pink' : ($data['order_status'] == '8' ? 'teal' : ($data['order_status'] == '9' ? 'brown' : ($data['order_status'] == '10' ? 'gray' : 'aqua'))))))))) ?>"></span>
                    <?= $data['order_status'] == '1' ? 'Packing' : ($data['order_status'] == '2' ? 'Shipped' : ($data['order_status'] == '3' ? 'Delivered' : ($data['order_status'] == '4' ? 'Cancel Requested' : ($data['order_status'] == '5' ? 'Cancelled' : ($data['order_status'] == '6' ? 'Refunded' : ($data['order_status'] == '7' ? 'On Hold' : ($data['order_status'] == '8' ? 'Backordered' : ($data['order_status'] == '9' ? 'Payment Pending' : ($data['order_status'] == '10' ? 'Completed' : 'Pending'))))))))) ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include("Includes/footer.php");
?>