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
                                            <input type="text" name="fname" value="<?php echo isset($_SESSION['input']['fname']) ? $_SESSION['input']['fname'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" value="<?php echo isset($_SESSION['input']['lname']) ? $_SESSION['input']['lname'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Phone</label>
                                            <input type="text" name="phone" value="<?php echo isset($_SESSION['input']['phone']) ? $_SESSION['input']['phone'] : ''; ?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label class="field-label">Email Address</label>
                                            <input type="email" name="email" value="<?php echo isset($_SESSION['input']['email']) ? $_SESSION['input']['email'] : ''; ?>" placeholder="">
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
                                            <label class="field-label">State / County</label>
                                            <input type="text" name="county" value="<?php echo isset($_SESSION['input']['country']) ? $_SESSION['input']['country'] : ''; ?>" placeholder="">
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
                    <div class="col-md-4 summary">
                        <div>
                            <h5><b>Summary</b></h5>
                        </div>
                        <hr>
                        <?php $items = getCartItems();
                        $totalPrice = 0;
                        foreach ($items as $item) {
                        ?>
                            <div class="row align-items-center">
                                <div class="col-3"><img class="img-fluid" src="Assets/<?= $item['image_source'] ?>"></div>
                                <div class="col">
                                    <div class="row" style="font-size: 16px; padding-left: 20px;"><?= $item['product_name'] ?></div>
                                    <div class="row text-muted" style="font-size: 12px; padding-left: 18px;">x <?= $item['product_qty'] ?></div>
                                </div>
                                <div class="col text-right" style="padding-left: 100px;">&dollar;<?= $item['product_price'] * $item['product_qty'] ?></div>
                            </div>
                            <hr>
                        <?php
                            $totalPrice += $item['product_price'] * $item['product_qty'];
                        }
                        ?>
                        <div>
                            <p>SHIPPING</p>
                            <select>
                                <option class="text-muted">Standard Delivery: &dollar;5</option>
                            </select>
                            <p>DISCOUNT</p>
                            <input type="text" id="code" placeholder="Enter promo code">
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding:2vh 0;">
                            <div class="col">TOTAL PRICE</div>
                            <div class="col text-right">&dollar;<?= $totalPrice ?></div>
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