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
    <button class="btn btn-primary filter-btn" data-status="all">All Orders</button>
    <button class="btn btn-success filter-btn" data-status="3">Delivered</button>
    <button class="btn btn-info filter-btn" data-status="10">Completed</button>
    <button class="btn btn-danger filter-btn" data-status="4">Cancelled</button>
                  </div>
                        <table class="table table-bordered text-white">
                            <thead>
                                <tr>
                                    <th>Order NO</th>
                                    <th>User ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Quantity</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Shipping method</th>
                                    <th>Payment Method</th>
                                    <th>Order Detail</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $orders = getOrderDetails();

                                if (mysqli_num_rows($orders) > 0) {
                                    foreach ($orders as $item) {
                                ?>
                                   <tr class="order-row" data-status="<?=$item['order_status']?>">
                                            <td><?= $item['Order_NO'] ?></td>
                                            <td><?=$item['user_id']?></td>
                                            <td><?= $item['shipping_firstname'] ?> <?= $item['shipping_lastname'] ?></td>
                                            <td><?=$item['total_qty']?></td>
                                            <td class="vertical-middle">
                                                <?= $item['order_status'] == '1' ? 'Packing Process' : ($item['order_status'] == '2' ? 'Shipped' : ($item['order_status'] == '3' ? 'Delivered' : ($item['order_status'] == '4' ? 'Cancelled' : ($item['order_status'] == '5' ? 'Refunded' : ($item['order_status'] == '6' ? 'Returned' : ($item['order_status'] == '7' ? 'On Hold' : ($item['order_status'] == '8' ? 'Backordered' : ($item['order_status'] == '9' ? 'Payment Pending' : ($item['order_status'] == '10' ? 'Completed' : 'Pending'))))))))) ?>
                                            </td>
                                            <td class="vertical-middle"><?= DATE("d/m/Y",strtotime($item['create_at']))?></td>
                                            <td class="vertical-middle">
                                            <?= $item['shipping_method'] == '0' ? 'Standard Delivery' : ($item['shipping_method'] == '1' ? 'Hyperspeed Delivery' : 'Standard Delivery') ?>
                                            </td>
                                            <td class="vertical-middle"><?= strtoupper($item['payment_method']) ?></td>
                                            <td class="vertical-middle">
                                                <a href="orderdetail.php?id=<?=$item['Order_NO']?>" class="detail-link" data-order-id="<?= $item['order_id'] ?>">
                                                <i class="bi bi-arrow-right-circle"></i>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
$(document).ready(function() {
    // Show all orders initially
    $(".order-row").show();

    // Button click event handlers
    $(".filter-btn").click(function() {
        var status = $(this).data("status");

        // Hide all rows
        $(".order-row").hide();

        if (status === "all") {
            // Show all rows if "All Orders" button is clicked
            $(".order-row").show();
        } else {
            // Show rows with the selected status
            $(".order-row[data-status='" + status + "']").show();
        }
    });
});
</script>
</main>
<?php
include("Includes/footer.php");
?>