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
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
				</p>
				<h1 class="mb-0 bread">My Order</h1>
			</div>
		</div>
	</div>
</div>
<div class="py-5">
    <div class="">
        <div class="row">
            <div class="col-md-8 cart">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Total Price</th>
                            <th>Date of Issue</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    $orders = getOrderDetails();

                    if (mysqli_num_rows($orders) > 0) {
                        foreach ($orders as $item) {
                    ?>
                            <tbody>
                                <div id="myOrder">
                                    <tr>
                                        <td class="vertical-middle"><a href="orderdetail.php?id=<?=$item['Order_NO']?>" ><?= $item['Order_NO'] ?></a></td>
                                        <td class="vertical-middle">&dollar;<?= $item['total_price'] ?></td>
                                        <td class="vertical-middle"><?= date("d/m/Y", strtotime($item['order_date']))?></td>
                                        <td class="vertical-middle">
                                            <span class="status-dot" style="background-color:
        <?= $item['order_status'] == '1' ? 'green' : ($item['order_status'] == '2' ? 'blue' : ($item['order_status'] == '3' ? 'purple' : ($item['order_status'] == '4' ? 'red' : ($item['order_status'] == '5' ? 'orange' : ($item['order_status'] == '6' ? 'yellow' : ($item['order_status'] == '7' ? 'pink' : ($item['order_status'] == '8' ? 'teal' : ($item['order_status'] == '9' ? 'brown' : ($item['order_status'] == '10' ? 'gray' : 'aqua'))))))))) ?>"></span>
                                            <?= $item['order_status'] == '1' ? 'Packing' : ($item['order_status'] == '2' ? 'Shipping' : ($item['order_status'] == '3' ? 'Delivered' : ($item['order_status'] == '4' ? 'Cancelled' : ($item['order_status'] == '5' ? 'Refuned' : ($item['order_status'] == '6' ? 'Returned' : ($item['order_status'] == '7' ? 'On Hold' : ($item['order_status'] == '8' ? 'Backordered' : ($item['order_status'] == '9' ? 'Payment Pending' : ($item['order_status'] == '10' ? 'Completed' : 'Pending'))))))))) ?>
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