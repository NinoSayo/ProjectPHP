<?php
include("Functions/userFunction.php");
include("Includes/header.php");
include("Functions/dbhelper.php");
$id = $_GET['id'];
$productResult = executeSingleResult("select * from product where product_id = $id");
$productImage = executeSingleResult("select image_source from product_image where product_id = $id ");
$productName = $productResult['product_name'];
$productPrice = $productResult['product_price'];
$productDes = $productResult['product_descriptions'];
$productImg = $productImage['image_source'];
?>

<body>
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
					<h1 class="mb-0 bread">Shop</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="" class="image-popup prod-img-bg"><img src="Assets/<?= $productImage['image_source']; ?>" class="img-fluid" alt=""></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?= $productResult['product_name'] ?></h3>
					<div class="rating d-flex">
						<p class="text-left mr-4">
							<a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
						</p>
						<p class="text-left">
							<a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
						</p>
					</div>
					<p class="price"><span><?= $productResult['product_price'] ?>$</span></p>
					<p><?= $productResult['product_descriptions'] ?></p>

					<div class="row mt-4">
						<div class="col-md-6">
							<div class="form-group d-flex">
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select name="" id="" class="form-control">
										<option value="">Small</option>
										<option value="">Medium</option>
										<option value="">Large</option>
										<option value="">Extra Large</option>
									</select>
								</div>
							</div>
						</div>
						<div class="w-100"></div>
						<div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
							<input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
							<span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
									<i class="ion-ios-add"></i>
								</button>
							</span>
						</div>
						<div class="w-100"></div>
						<div class="col-md-12">
							<p style="color: #000;">80 piece available</p>
						</div>
					</div>
					<p><a href="cart.html" class="btn btn-black py-3 px-5 mr-2">Add to Cart</a><a href="cart.html" class="btn btn-primary py-3 px-5">Buy now</a></p>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col-md-12 nav-link-wrap">
					<div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Reviews</a>

					</div>
				</div>
				<div class="col-md-12 tab-wrap">
					<div class="tab-content bg-light" id="v-pills-tabContent">
						<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
							<div class="row p-4">
								<div class="col-md-7">
									<h3 class="mb-4">23 Reviews</h3>
									<div class="review">
										<div class="comment-section">
											<h3>Comments</h3>
											<form id="comment-form">
												<input type="hidden" id="product-id" value="<?= $id ?>">
												<input type="text" id="user-name" placeholder="Your Name">
												<textarea id="comment-content" placeholder="Your Comment"></textarea>
												<button type="button" id="submit-comment">Submit Comment</button>
											</form>
											<div id="comments-list"></div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
		$(document).ready(function() {
			$("#submit-comment").click(function() {
				var productId = $("#product-id").val();
				var userName = $("#user-name").val();
				var commentContent = $("#comment-content").val();
				// alert(userName);
				$.ajax({
					type: "POST",
					url: "Functions/process_comment.php", // Đường dẫn đến script PHP xử lý bình luận
					data: {
						productId: productId,
						userName: userName,
						commentContent: commentContent
					},
					success: function(respone) {
						alert(respone);
					}
				});
			});

			// Hàm cập nhật danh sách bình luận bằng Ajax
			function updateComments(productId) {
				$.ajax({
					type: "GET",
					url: "Functions/get_comments.php", // Đường dẫn đến script PHP để lấy danh sách bình luận
					data: {
						productId: productId
					},
					success: function(data) {
						$("#comments-list").html(data);
					}
				});
			}
		});
	</script>

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
</body>

</html>
<?php
include("Includes/js.php");
include("Includes/footer.php");
?>