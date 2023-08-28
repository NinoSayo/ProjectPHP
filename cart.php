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
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
				<h1 class="mb-0 bread">Cart</h1>
			</div>
		</div>
	</div>
</div>

    <?php
    $items = getCartItems();
    $numItems = mysqli_num_rows($items);

    if ($numItems > 0) {
        $groupedItems = array();

        foreach ($items as $item) {
            $productId = $item['pid'];
            if (!isset($groupedItems[$productId])) {
                $groupedItems[$productId] = array(
                    'product' => $item,
                    'quantity' => 0
                );
            }
            $groupedItems[$productId]['quantity'] += $item['product_qty'];
        }
    }
    ?>

    <div class="py-5">
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Shopping Cart</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">
                                <?php echo $numItems; ?> item(s) in cart
                            </div>
                        </div>
                    </div>
                    <div id="myCart">
                        <?php
                        if ($numItems > 0) {
                            foreach ($groupedItems as $productId => $groupedItem) {
                                $item = $groupedItem['product'];
                                $quantity = $groupedItem['quantity'];
                                ?>
                                <div class="row border-top border-bottom product_data">
                                    <div class="row main align-items-center">
                                        <div class="col-2">
                                            <img class="img-fluid" src="Assets/<?= $item['image_source'] ?>">
                                        </div>
                                                <div class="col">
                                                    <div class="row text-muted" style="font-size:12px;"><?= $item['category_name'] ?></div>
                                                    <div class="row" style="font-size:18px;"><?= $item['product_name'] ?></div>
                                                </div>
                                                <div class="col-md-4" id="qty">
                                                    <input type="hidden" class="prodID" value="<?= $item['pid']; ?>">
                                                    <div class="input-group mb-0" style="width: 120px; align-items:center;">
                                                        <input type="hidden" class="available-qty" data-available-qty="<?= $item['product_quantity']; ?>">
                                                        <Button class="input-group-text decrement-btn updateQty " style="height:38px">-</Button>
                                                        <input type="text" class="form-control text-center input-qty bg-white" value="<?= $item['product_qty']; ?>" disabled>
                                                        <Button class="input-group-text increment-btn updateQty" style="height:38px">+</Button>
                                                    </div>
                                                </div>
                                                <div class="col">&dollar;<?= $item['product_price'] ?><span class="close deleteItem" value="<?= $item['cid'] ?>"><i class="bi bi-trash3"></i></span></div>
                                                </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="card card-body text-center" style="box-shadow: none; background-color: #ddd;">
                                <h4 class="py-3" style="color: red;">Your cart is empty</h4>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="back-to-shop">
                        <a href="#"><i class="bi bi-arrow-left"></i></a>
                        <span class="text-muted">Back to Shop</span>
                    </div>
                </div>
                <div class="col-md-4 summary">
                    <div>
                            <h5><b>Head to checkout</b></h5>
                        </div>
                        <hr>
                        <?php if ($numItems > 0) { ?>
                        <button class="btn checkout-btn" onclick="location.href='checkout.php'">
                            <i class="bi bi-cart-check"></i> CHECKOUT
                        </button>
                    <?php } else { ?>
                        <button class="btn checkout-btn" disabled>
                            <i class="bi bi-cart-check"></i> CHECKOUT
                        </button>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <?php

        include("Includes/footer.php");

        ?>