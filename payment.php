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
            <a class="text-white" href="payment.php">
                Checkout
            </a>
        </h6>
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
                                    <input type="text" name="fname" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="field-label">Phone</label>
                                    <input type="text" name="phone" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label class="field-label">Email Address</label>
                                    <input type="email" name="email" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">Country</label>
                                    <select name="country">
                                        <option>India</option>
                                        <option>South Africa</option>
                                        <option>United State</option>
                                        <option>Australia</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">Address</label>
                                    <input type="text" name="address" value="" placeholder="Street address">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="field-label">Town / City</label>
                                    <input type="text" name="city" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <label class="field-label">State / County</label>
                                    <input type="text" name="county" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <label class="field-label">Postal Code</label>
                                    <input type="text" name="pin" value="" placeholder="">
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