<?php

include("Functions/userFunction.php");
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
            <a class="text-white" href="shoppingCart.php">
                Cart
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
                            <h4><b>Shopping Cart</b></h4>
                        </div>
                        <div class="col align-self-center text-right text-muted">Number of items</div>
                    </div>
                </div>
                <?php $items = getCartItems();
                foreach ($items as $item) {
                ?>
                    <div class="row border-top border-bottom product_data">
                        <div class="row main align-items-center">
                            <div class="col-2"><img class="img-fluid" src="Assets/<?= $item['image_source'] ?>"></div>
                            <div class="col">
                                <div class="row text-muted" style="font-size:12px;"><?= $item['category_name'] ?></div>
                                <div class="row" style="font-size:18px;"><?= $item['product_name'] ?></div>
                            </div>
                            <div class="col-md-4" id="qty">
                                <div class="input-group mb-0" style="width: 120px; align-items:center;">
                                    <Button class="input-group-text decrement-btn" style="height:38px">-</Button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="<?= $item['product_qty']; ?>" disabled>
                                    <Button class="input-group-text increment-btn" style="height:38px">+</Button>
                                </div>
                            </div>
                            <div class="col">&dollar;<?= $item['product_price'] ?><span class="close"><i class="bi bi-trash3"></i></span></div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="back-to-shop"><a href="#"><i class="bi bi-arrow-left"></i></a><span class="text-muted">Back to Shop</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5><b>Summary</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">Number of Items</div>
                    <div class="col text-right">&dollar; Total price</div>
                </div>
                <form>
                    <p>SHIPPING</p>
                    <select>
                        <option class="text-muted">Standard Delivery: &dollar;5</option>
                    </select>
                    <p>DISCOUNT</p>
                    <input type="text" id="code" placeholder="Enter promo code">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding:2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&dollar;Total price</div>
                </div>
                <button class="btn checkout-btn"><i class="bi bi-cart-check"></i> CHECKOUT</button>
            </div>
        </div>
    </div>
</div>
<?php

include("Includes/footer.php");

?>