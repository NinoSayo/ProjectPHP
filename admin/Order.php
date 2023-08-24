<?php
session_start();
include("../Functions/orderStatus.php");
include("../Functions/myFunction.php");
include("../Middleware/admin.php");
include("Includes/header.php");
?>
<main class="mt-5 pt-3 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-theme bg-dark shadow-lg">
                    <div class="card-header">
                        <h4>Order list</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <button class="btn btn-primary mr-2" id="btnAllOrders">All Orders</button>
                            <button class="btn btn-success mr-2" id="btnDelivered">Delivered</button>
                            <button class="btn btn-info mr-2" id="btnCompleted">Completed</button>
                            <button class="btn btn-danger" id="btnCancelled">Cancelled</button>
                        </div>
                        <table class="table table-bordered text-white">
                            <thead>
                                <tr>
                                    <th>Order NO</th>
                                    <th>User ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Update Status</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders = getOrderDetails();

                                if (mysqli_num_rows($orders) > 0) {
                                    foreach ($orders as $item) {
                                ?>
                                        <tr>
                                            <td><?= $item['Order_NO'] ?></td>
                                            <td><?= $item['shipping_firstname'] ?> <?= $item['shipping_lastname'] ?></td>
                                            <td>
                                                <?php
                                                $image_sources = explode(',', $item['image_sources']);
                                                foreach ($image_sources as $image_source) {
                                                    echo '<img src="../Assets/' . $image_source . '" class="w-50" alt="Product Image">';
                                                }
                                                ?>
                                            </td>
                                            <td class="vertical-middle"><?= $item['product_name'] ?></td>
                                            <td><?= $item['item_qty'] ?></td>
                                            <td class="vertical-middle">
                                                <?= $item['order_status'] == '1' ? 'Packing Process' : ($item['order_status'] == '2' ? 'Shipped' : ($item['order_status'] == '3' ? 'Delivered' : ($item['order_status'] == '4' ? 'Cancelled' : ($item['order_status'] == '5' ? 'Refunded' : ($item['order_status'] == '6' ? 'Returned' : ($item['order_status'] == '7' ? 'On Hold' : ($item['order_status'] == '8' ? 'Backordered' : ($item['order_status'] == '9' ? 'Payment Pending' : ($item['order_status'] == '10' ? 'Completed' : 'Pending'))))))))) ?>
                                            </td>
                                            <td class="vertical-middle"><?= DATE("d/m/Y",strtotime($item['create_at']))?></td>
                                            <td class="vertical-middle"><?= strtoupper($item['payment_method']) ?></td>
                                            <td class="vertical-middle">
                                                <a href="orderdetail.php" class="detail-link" data-order-id="<?= $item['order_id'] ?>">
                                                    <i class="bi bi-check-circle"></i>
                                                </a>
                                            </td>
                                            <td class="vertical-middle">
                                                <a href="#" class="delete-link" data-order-id="<?= $item['order_id'] ?>">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="12">No Orders Found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="modal" id="statusModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Select New Order Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <select id="newStatus" class="form-control">
                                            <option value="0" <?= $item['order_status'] == 0 ? 'selected' : '' ?>>Pending</option>
                                            <option value="1" <?= $item['order_status'] == 1 ? 'selected' : '' ?>>Packing Process</option>
                                            <option value="2" <?= $item['order_status'] == 2 ? 'selected' : '' ?>>Shipped</option>
                                            <option value="3" <?= $item['order_status'] == 3 ? 'selected' : '' ?>>Delivered</option>
                                            <option value="4" <?= $item['order_status'] == 4 ? 'selected' : '' ?>>Cancelled</option>
                                            <option value="5" <?= $item['order_status'] == 5 ? 'selected' : '' ?>>Refunded</option>
                                            <option value="6" <?= $item['order_status'] == 6 ? 'selected' : '' ?>>Returned</option>
                                            <option value="7" <?= $item['order_status'] == 7 ? 'selected' : '' ?>>On Hold</option>
                                            <option value="8" <?= $item['order_status'] == 8 ? 'selected' : '' ?>>Backordered</option>
                                            <option value="9" <?= $item['order_status'] == 9 ? 'selected' : '' ?>>Payment Pending</option>
                                            <option value="10" <?= $item['order_status'] == 10 ? 'selected' : '' ?>>Completed</option>
                                        </select>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="confirmStatus">Confirm</button>
                                    </div>
                                </div>
                            </div>
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