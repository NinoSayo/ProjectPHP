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
<!-- Replace the "test" client-id value with your client-id -->
<script src="Assets/JS/jquery-3.7.min.js"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AWfDjbD6t-BlDAz2nZt4Ns6fxEF-KNTsCkJDJLBb7EQiAy01p0WXu7n8o-fiSl2wYIW4Gri7xDfVVRCN&currency=USD"></script>

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
								<input type="text" name="fname" id="fname" class="form-control" value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" placeholder="">
								<small class="text-danger fname"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="lastname">Last Name</label>
								<input type="text" name="lname" id="lname" class="form-control" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" placeholder="">
								<small class="text-danger lname"></small>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="country">State / Country</label>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="country" id="country" class="form-control">
										<option value="VN" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'VN' ? 'selected' : ''; ?>>Vietnam</option>
										<option value="US" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'US' ? 'selected' : ''; ?>>USA</option>
										<option value="UK" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'UK' ? 'selected' : ''; ?>>United Kingdom</option>
										<option value="KR" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'KR' ? 'selected' : ''; ?>>South Korea</option>
										<option value="HK" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'HK' ? 'selected' : ''; ?>>Hongkong</option>
										<option value="JP" <?php echo isset($_SESSION['input']['country']) && $_SESSION['input']['country'] === 'JP' ? 'selected' : ''; ?>>Japan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="streetaddress">Street Address</label>
								<input type="text" name="address" id="address" class="form-control" value="<?php echo isset($_SESSION['input']['address']) ? $_SESSION['input']['address'] : ''; ?>" placeholder="House number and street name">
								<small class="text-danger address"></small>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="towncity">Town / City</label>
								<input type="text" name="city" id="city" value="<?php echo isset($_SESSION['input']['city']) ? $_SESSION['input']['city'] : ''; ?>" class="form-control" placeholder="">
								<small class="text-danger city"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="postcodezip">Postcode / ZIP *</label>
								<input type="text" name="pin" id="pin" value="<?php echo isset($_SESSION['input']['pin']) ? $_SESSION['input']['pin'] : ''; ?>" class="form-control" placeholder="">
								<small class="text-danger pin"></small>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="text" name="phone" id="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : ''; ?>" class="form-control" placeholder="">
								<small class="text-danger phone"></small>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="emailaddress">Email Address</label>
								<input type="text" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" class="form-control" placeholder="">
								<small class="text-danger email"></small>
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
										<span id="subtotal">$<?= $summary['product_total_price'] ?></span>
									</p>
									<p class="d-flex">
										<span>Delivery</span>
										<span>
											<select id="shippingMethod" name="shipping_method">
												<option value="0" class="text-muted" selected>Standard Delivery: $5</option>
												<option value="1" class="text-muted">Hyperspeed Delivery: $20</option>
											</select>
										</span>
									</p>
									<p class="d-flex">
										<span>Total</span>
										<span id="total"></span>
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="cart-detail bg-light p-3 p-md-4">
									<input type="hidden" name="payment_method" value="COD">
									<button type="submit" name="placeOrder" class="btn btn-primary checkout-btn  mt-2"><i class="bi bi-cart-check"></i> PLACE ORDER</button>
									<div id="paypal-button-container" class="mt-3"></div>
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

	const subtotalElement = document.getElementById("subtotal");
	const shippingMethodElement = document.getElementById("shippingMethod");
	const totalElement = document.getElementById("total");

	// Initial calculation
	updateTotal();

	// Listen for changes in the shipping method selection
	shippingMethodElement.addEventListener("change", updateTotal);

	function updateTotal() {
		const subtotal = parseFloat(subtotalElement.textContent.replace("$", ""));
		const selectedShippingMethod = shippingMethodElement.value;
		const deliveryFee = selectedShippingMethod === "1" ? 20 : 5;
		const total = subtotal + deliveryFee;

		totalElement.textContent = "$" + total.toFixed(2);
	}

	// Render the PayPal button into the container
	paypal.Buttons({
		onClick() {
			console.log("Onclick");
			var lname = $('#lname').val();
			var fname = $('#fname').val();
			var phone = $('#phone').val();
			var email = $('#email').val();
			var address = $('#address').val();
			var pin = $('#pin').val();
			var city = $('#city').val();
			var country = $('#country').val();
			

			if (lname.length == 0) {
				$('.lname').text("*This field is required");
			} else {
				$('.lname').text("");
			}
			if (fname.length == 0) {
				$('.fname').text("*This field is required");
			} else {
				$('.fname').text("");
			}

			if (phone.length == 0) {
				$('.phone').text("*This field is required");
			} else {
				$('.phone').text("");
			}

			if (email.length == 0) {
				$('.email').text("*This field is required");
			} else {
				$('.email').text("");
			}

			if (address.length == 0) {
				$('.address').text("*This field is required");
			} else {
				$('.address').text("");
			}

			if (pin.length == 0) {
				$('.pin').text("*This field is required");
			} else {
				$('.pin').text("");
			}

			if (city.length == 0) {
				$('.city').text("*This field is required");
			} else {
				$('.city').text("");
			}

			if (lname.length == 0 || fname.length == 0 || phone.length == 0 || email.length == 0 || address.length == 0 || pin.length == 0 || city.length == 0) {
				return false;
			}
		},
		createOrder: function(data, actions) {
			console.log("Create Order");
			//Get the calculated total amount from the "Total" span
			const totalAmount = parseFloat(document.getElementById("total").textContent.replace("$", ""));
			// Set up the transaction details, including the amount, currency, and items
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: totalAmount.toFixed(2) // Replace with your calculated total amount
					}
				}]
			});
		},
		onApprove: function(data, actions) {
			// Capture the approved payment and handle the successful transaction
			return actions.order.capture().then(function(details) {
				console.log(details);
				const transaction = details.id;

				var lname = $('#lname').val();
				var fname = $('#fname').val();
				var phone = $('#phone').val();
				var email = $('#email').val();
				var address = $('#address').val();
				var pin = $('#pin').val();
				var city = $('#city').val();
				var country = $('#country').val();

				var data = {
					'fname': fname,
					'lname': lname,
					'phone': phone,
					'email': email,
					'address': address,
					'country': country,
					'city': city,
					'pin': pin,
					'payment_method': "Paid by Paypal",
					'payment_id': transaction,
					'placeOrder' : true,
					'shipping_method': $('#shippingMethod').val(),
				};

				$.ajax({
					method: "POST",
					url: "Functions/orderFunction.php",
					data: data,
					success: function(response) {
						console.log(response)
						if(response == 201){
							alertify.success("Order Placed Successfully");
							window.location.href = 'myOrder.php';
						}else{
							console.log(response);
						}
					}
				});
			});
		}
	}).render('#paypal-button-container');
</script>

<?php

include("Includes/footer.php");

?>