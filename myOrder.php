<?php

include("Functions/userFunction.php");
include("Functions/redirect.php");
include("Functions/authenticate.php");
include("Includes/header.php");
?>
<link rel="stylesheet" href="Assets/CSS/cart.css">
<style>
    .form-control {
        margin-top: 31px;
    }
</style>
<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
            <a class="text-white" href="index.php">
                Home
            </a> /
            <a class="text-white" href="myOrder.php">
                My Orders
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="card">
        <div class="row">
            <div class="col-md-8 cart">
                <table class="table table-bordered table-striped text-center">
                    <?php
                            $orders = getOrderDetails();

                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Payment </th>
                            <th>Date of Issue</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="myOrder">
                                    <tr>
                                        <td class="vertical-middle"><?= $item['order_id'] ?></td>
                                        <td class="vertical-middle"><?= $item['product_name'] ?></td>
                                        <td class="vertical-middle"><?= $item['total_price'] ?></td>
                                        <td class="vertical-middle"><?= strtoupper($item['payment_method']) ?></td>
                                        <td class="vertical-middle"><?= $item['create_at'] ?></td>
                                        <td class="vertical-middle">
                                            <span class="status-dot" style="background-color:
        <?= $item['order_status'] == '1' ? 'green' : ($item['order_status'] == '2' ? 'blue' : ($item['order_status'] == '3' ? 'purple' : ($item['order_status'] == '4' ? 'red' : ($item['order_status'] == '5' ? 'orange' : ($item['order_status'] == '6' ? 'yellow' : ($item['order_status'] == '7' ? 'pink' : ($item['order_status'] == '8' ? 'teal' : ($item['order_status'] == '9' ? 'brown' : ($item['order_status'] == '10' ? 'gray' : 'aqua'))))))))) ?>"></span>
                                            <?= $item['order_status'] == '1' ? 'Packing Process' : ($item['order_status'] == '2' ? 'Shipped' : ($item['order_status'] == '3' ? 'Delivered' : ($item['order_status'] == '4' ? 'Cancelled' : ($item['order_status'] == '5' ? 'Refunded' : ($item['order_status'] == '6' ? 'Returned' : ($item['order_status'] == '7' ? 'On Hold' : ($item['order_status'] == '8' ? 'Backordered' : ($item['order_status'] == '9' ? 'Payment Pending' : ($item['order_status'] == '10' ? 'Completed' : 'Pending'))))))))) ?>
                                        </td>
                                        <td class="vertical-middle">
                                            <a href="#" class="details-link" style="color: blue;"><i class="bi bi-arrow-right-circle"></i><span class="details-text">View Details</span></a>
                                            <?php if ($item['order_status'] != '4') { ?>
                                                <a href="#" class="cancel-link" data-order-id="<?= $item['order_id'] ?>" style="color: red;">
                                                    <i class="bi bi-x-circle"></i><span class="cancel-text">Cancel</span>
                                                </a> <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">No Order Founds</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </div>
                    </tbody>
                </table>
                <div id="myCart">

                </div>
                <div class="back-to-shop"><a href="index.php"><i class="bi bi-arrow-left"></i><span class="text-muted"> Back to Home</span></a></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>User Details</b></h5>
                </div>
                <hr>
                <div>
                    <?php
                    if (mysqli_num_rows($orders) > 0) {
                    ?>
                        <p><strong>Name:</strong> <?= $item['shipping_firstname'] ?> <?= $item['shipping_lastname'] ?></p>
                        <p><strong>Phone:</strong> <?= $item['shipping_phone'] ?></p>
                        <p><strong>Email:</strong> <?= $item['shipping_email'] ?></p>
                        <p><strong>Country:</strong> <?= $item['shipping_country'] ?></p>
                        <p><strong>Address:</strong> <?= $item['shipping_address'] ?></p>
                        <p><strong>City:</strong> <?= $item['shipping_city'] ?></p>
                        <p><strong>Postal Code:</strong> <?= $item['shipping_pin'] ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("Includes/footer.php");
?>