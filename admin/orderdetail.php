<?php
session_start();
include("../Functions/myFunction.php");
include("../Middleware/admin.php");
include("Includes/header.php");

if (isset($_GET['id'])) {
    $orderNO = $_GET['id'];

    $result = OrderList($orderNO);
    $data = mysqli_fetch_array($result);
}
?>
<main class="mt-2 pt-2 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-theme bg-dark shadow-lg">
                    <div class="row">
                        <div class="col-md-8 cart">
                            <div class="title">
                                <div class="row">
                                    <div class="col ms-3 mt-2">
                                        <h4>Delivery Details</h4>
                                    </div>
                                    <div class="col align-self-center text-right text-muted">
                                        <a href="Order.php"><i class="bi bi-arrow-left"> Back</i></a>
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
                                                    <label>Email:</label>
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
                        <div class="col-md-4 summary card-header">
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
                                    $orderDetail = "SELECT o.order_id as oid,o.Order_NO,o.user_id,oi.*,p.*,pi.image_source
                FROM orders o, order_items oi,product p,product_image pi
                WHERE oi.order_id = o.order_id AND p.product_id = oi.product_id AND o.Order_NO = '$orderNO' AND pi.product_id = oi.product_id";
                                    $orderRun = mysqli_query($con, $orderDetail);
                                    $previousProductId = null;
                                    if ($orderRun && mysqli_num_rows($orderRun) > 0) {
                                        while ($items = mysqli_fetch_assoc($orderRun)) {
                                            if ($items['product_id'] !== $previousProductId) {
                                    ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <img src="../Assets/<?= $items['image_source'] ?>" width="50px" alt="">
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
                            <label for="">Shipping method</label>
                                <select disabled class="form-control bg-dark text-light">
                                    <option value="0" <?=$data['shipping_method'] == 0 ? 'selected' : ''?>>Standard Delivery</option>
                                    <option value="1" <?=$data['shipping_method'] == 1 ? 'selected' : ''?>>Hyperspeed Delivery</option>
                                </select>
                            <label for="payment" class="my-1">Payment method</label>
                            <div class="border p-1">
                                <?= strtoupper($data['payment_method']) ?>
                            </div>
                            <label for="status" class="my-1">Status</label>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="Order_NO" value="<?=$data['Order_NO']?>">
                                <select name="order_status" class="form-control bg-dark text-light">
                                    <option value="0" <?= $data['order_status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                    <option value="1" <?= $data['order_status'] == 1 ? 'selected' : '' ?>>Packing</option>
                                    <option value="2" <?= $data['order_status'] == 2 ? 'selected' : '' ?>>Shipping</option>
                                    <option value="3" <?= $data['order_status'] == 3 ? 'selected' : '' ?>>Delivered</option>
                                    <option value="4" <?= $data['order_status'] == 4 ? 'selected' : '' ?>>Cancelled</option>
                                    <option value="5" <?= $data['order_status'] == 5 ? 'selected' : '' ?>>Refunded</option>
                                    <option value="6" <?= $data['order_status'] == 6 ? 'selected' : '' ?>>Returned</option>
                                    <option value="7" <?= $data['order_status'] == 7 ? 'selected' : '' ?>>On Hold</option>
                                    <option value="8" <?= $data['order_status'] == 8 ? 'selected' : '' ?>>Backordered</option>
                                    <option value="9" <?= $data['order_status'] == 9 ? 'selected' : '' ?>>Payment Pending</option>
                                    <option value="10" <?= $data['order_status'] == 10 ? 'selected' : '' ?>>Completed</option>
                                </select>
                                <button type="submit" name="UpdateOrder" class="btn btn-primary mt-2">Update Status</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
include("Includes/footer.php");
?>