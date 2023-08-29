<?php



include("Functions/userFunction.php");
include("Functions/redirect.php");
include("Functions/authenticate.php");

$items = getCartItems();
$numItems = mysqli_num_rows($items);
if ($numItems === 0) {
    redirect("cart.php", "You don't have any items in cart"); // Redirect to cart page if cart is empty
}


include("Includes/header.php");

?>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span>
				</p>
				<h1 class="mb-0 bread">Checkout</h1>
			</div>
		</div>
	</div>
</div>

<section class="ftco-section">
	<div class="container">
	<?php
                $userResult = getUserDetails();
                if (mysqli_num_rows($userResult) > 0) {
                    $user = mysqli_fetch_assoc($userResult);
                }
                ?>
		<div class="row justify-content-center">
			<div class="col-xl-10 ftco-animate">
				<form action="Functions/orderFunction.php" class="billing-form" method="POST">
					<h3 class="mb-4 billing-heading">Billing Details</h3>
					<div class="row align-items-end">
						<div class="col-md-6">
							<div class="form-group">
								<label for="firstname">Firt Name</label>
								<input type="text" name="fname" class="form-control" value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" name="lname" class="form-control" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="country">State / Country</label>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="country" id="" class="form-control">
										<option value="VN"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'VN' ? 'selected' : ''; ?>>Vietnam</option>
										<option value="US"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'US' ? 'selected' : ''; ?>>USA</option>
										<option value="UK"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'UK' ? 'selected' : ''; ?>>United Kingdom</option>
										<option value="KR"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'KR' ? 'selected' : ''; ?>>South Korea</option>
										<option value="HK"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'HK' ? 'selected' : ''; ?>>Hongkong</option>
										<option value="JP"<?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'JP' ? 'selected' : ''; ?>>Japan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="streetaddress">Street Address</label>
								<input type="text" name="address" class="form-control" value="<?php echo isset($_SESSION['input']['address']) ? $_SESSION['input']['address'] : ''; ?>" placeholder="House number and street name">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="towncity">Town / City</label>
								<input type="text" name="city" value="<?php echo isset($_SESSION['input']['city']) ? $_SESSION['input']['city'] : ''; ?>" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcodezip">Postcode / ZIP *</label>
								<input type="text" name="pin" value="<?php echo isset($_SESSION['input']['pin']) ? $_SESSION['input']['pin'] : ''; ?>" class="form-control" placeholder="">
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" name="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : ''; ?>" class="form-control" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="emailaddress">Email Address</label>
								<input type="text" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" class="form-control" placeholder="">
							</div>
						</div>
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
					<?php foreach ($productSummaries as $productId => $summary) : ?>
				<div class="row mt-5 pt-3 d-flex">
					<div class="col-md-6 d-flex">
						<div class="cart-detail cart-total bg-light p-3 p-md-4">
							<h3 class="billing-heading mb-4">Cart Total</h3>
							<p class="d-flex">
								<span>Subtotal</span>
								<span>$<?= $summary['product_total_price'] ?></span>
							</p>
							<p class="d-flex">
								<span>Delivery</span>
								<span><select name="shipping_method">
                                <option value="0" class="text-muted" selected>Standard Delivery: &dollar;5</option>
                                <option value="1" class="text-muted">Hyperspeed Delivery: &dollar;20</option>
                            </select></span>
							</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="cart-detail bg-light p-3 p-md-4">
							<h3 class="billing-heading mb-4">Payment Method</h3>
							<select name="payment_method">
                                <option value="momo">Mobile Money (MoMo)</option>
                                <option value="paypal">PayPal</option>
                                <option value="credit_card">Credit/Debit Card</option>
                                <option value="cod">COD</option>
                            </select>
							<button type="submit" name="placeOrder" class="btn btn-primary checkout-btn mt-2"><i class="bi bi-cart-check"></i> CHECKOUT</button>
						</div>
						</form>
					</div>
				</div>
				<?php $totalPrice += $summary['product_total_price']; ?>
                        <?php endforeach; ?>
			</div> <!-- .col-md-8 -->
		</div>
	</div>
</section> <!-- .section -->
<script>
	$(document).ready(function() {
		var quantitiy = 0;
		$('.quantity-right-plus').click(function(e) {
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());
			// If is not undefined
			$('#quantity').val(quantity + 1);
			// Increment
		});
		$('.quantity-left-minus').click(function(e) {
			// Stop acting like a button
			e.preventDefault();
			// Get the field name
			var quantity = parseInt($('#quantity').val());
			// If is not undefined
			// Increment
			if (quantity > 0) {
				$('#quantity').val(quantity - 1);
			}
		});
	});
</script>

<?php

include("Includes/footer.php");
include("Includes/jg.php");

?>