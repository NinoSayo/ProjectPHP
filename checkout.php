<?php

include("Functions/userFunction.php");
include("Functions/redirect.php");
include("Functions/authenticate.php");
include("Includes/header.php");
$items = getCartItems();
$numItems = mysqli_num_rows($items);
if ($numItems === 0) {
    redirect("cart.php", "You don't have any items in cart"); // Redirect to cart page if cart is empty
}


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
                <p class="bread"><span><a href="index.php">Home</a></span>/ <span>Checkout</span></p>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row row-pb-lg">
        <div class="col-md-10 offset-md-1">
            <div class="process-wrap">
                <div class="process text-center">
                    <p><span>01</span></p>
                    <h3>Shopping Cart</h3>
                </div>
                <div class="process text-center active">
                    <p><span>02</span></p>
                    <h3>Checkout</h3>
                </div>
                <div class="process text-center">
                    <p><span>03</span></p>
                    <h3>Order Complete</h3>
                </div>
            </div>
        </div>

        <div class="py-5">
            <div class="card">
                <?php
                $userResult = getUserDetails();
                if (mysqli_num_rows($userResult) > 0) {
                    $user = mysqli_fetch_assoc($userResult);
                }
                ?>
                <div class="row">
                    <div class="col-md-8 cart">
                        <div class="title">
                            <div class="row">
                                <div class="col">
                                    <h4><b>Billing Detail</b></h4>
                                </div>
                            </div>
                            <form id="billingForm" action="Functions/orderFunction.php" method="POST">
                                <div class="theme-form">
                                    <div class="row check-out ">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>First Name</label>
                                            <input type="text" name="fname" value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Phone</label>
                                            <input type="text" name="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Email Address</label>
                                            <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">Country</label>
                                            <select name="country">
                                                <option value="India" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'India' ? 'selected' : ''; ?>>India</option>
                                                <option value="South Africa" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'South Africa' ? 'selected' : ''; ?>>South Africa</option>
                                                <option value="United State" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'United State' ? 'selected' : ''; ?>>United State</option>
                                                <option value="Australia" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'Australia' ? 'selected' : ''; ?>>Australia</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">Address</label>
                                            <input type="text" name="address" value="<?php echo isset($_SESSION['input']['address']) ? $_SESSION['input']['address'] : ''; ?>" placeholder="Street address">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="field-label">Town / City</label>
                                            <input type="text" name="city" value="<?php echo isset($_SESSION['input']['city']) ? $_SESSION['input']['city'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                            <label class="field-label">Postal Code</label>
                                            <input type="text" name="pin" value="<?php echo isset($_SESSION['input']['pin']) ? $_SESSION['input']['pin'] : ''; ?>" placeholder="">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="back-to-shop"><a href="#"><i class="bi bi-arrow-left"></i></a><span class="text-muted">Back to Shop</span></div>
                    </div>
                    <?php
                    $items = getCartItems();
                    $productSummaries = array(); // Initialize an array to hold product summaries

                    foreach ($items as $item) {
                        $productId = $item['pid'];
                        if (!isset($productSummaries[$productId])) {
                            // Initialize product summary
                            $productSummaries[$productId] = array(
                                'image_source' => $item['image_source'],
                                'product_name' => $item['product_name'],
                                'product_qty' => $item['product_qty'],
                                'product_total_price' => $item['product_price'] * $item['product_qty']
                            );
                        } else {
                            // Accumulate quantities and total price for the same product
                            $productSummaries[$productId]['product_qty'] += $item['product_qty'];
                            $productSummaries[$productId]['product_total_price'] += $item['product_price'] * $item['product_qty'];
                        }
                    }

                    $totalPrice = 0;
                    ?>
                    <div class="col-md-4 summary">
                        <div>
                            <h5><b>Summary</b></h5>
                        </div>
                        <hr>

                        <?php foreach ($productSummaries as $productId => $summary) : ?>
                            <div class="row align-items-center">
                                <div class="col-3"><img class="img-fluid" src="Assets/<?= $summary['image_source'] ?>"></div>
                                <div class="col">
                                    <div class="row" style="font-size: 16px; padding-left: 20px;"><?= $summary['product_name'] ?></div>
                                    <div class="row text-muted" style="font-size: 12px; padding-left: 18px;">x <?= $summary['product_qty'] ?></div>
                                </div>
                                <div class="col text-right" style="padding-left: 100px;">&dollar;<?= $summary['product_total_price'] ?></div>
                            </div>
                            <hr>
                            <?php $totalPrice += $summary['product_total_price']; ?>
                        <?php endforeach; ?>
                        <div>
                            <p>SHIPPING</p>
                            <select name="shipping_method">
                                <option value="0" class="text-muted" selected>Standard Delivery: &dollar;5</option>
                                <option value="1" class="text-muted">Hyperspeed Delivery: &dollar;20</option>
                            </select>
                            <p>DISCOUNT</p>
                            <input type="text" id="code" placeholder="Enter promo code">
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="field-label">Payment Method</label>
                            <select name="payment_method">
                                <option value="momo">Mobile Money (MoMo)</option>
                                <option value="paypal">PayPal</option>
                                <option value="credit_card">Credit/Debit Card</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <button type="submit" name="placeOrder" class="btn checkout-btn"><i class="bi bi-cart-check"></i> CHECKOUT</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <?php

        include("Includes/footer.php");

        ?>