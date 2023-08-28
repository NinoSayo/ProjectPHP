<?php
include("Functions/userFunction.php");
include("Includes/header.php");
include("Database/Connect.php");

if (isset($_POST["submit"])) {
	// Get the search query from the form
	$searchTerm = $_POST["search"];

	// var_dump($searchTerm);

	// Search for products based on the query
	$products = searchProducts($searchTerm);
}
?>
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
<section class="ftco-section bg-light">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-10 order-md-last">
				<div class="row" id="filtered-products">
					<?php
					if (isset($products) && !empty($products)) {
						$productsToDisplay = $products;
					} else {
						$productsToDisplay = getProductsWithImages();
					}

					foreach ($productsToDisplay as $p) :
					
					?>
						<div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
							<div class="product d-flex flex-column">
								<a href="product-single.php?id=<?= $p['product_id'] ?>" class="img-prod">
									<img class="img-fluid" src="Assets/<?= $p['image_source'] ?>" alt="">
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3">
									<div class="d-flex">
										<div class="cat">
											<span></span>
										</div>
									</div>
									<h3><a href="#"><?= $p['product_name'] ?></a></h3>
									<div class="pricing">
										<p class="price"><span><?= $p['product_price'] ?>$</span></p>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

					<?php if (empty($productsToDisplay)) : ?>
						<div class="col-md-12 text-center">
							<p>No products found for your search.</p>
						</div>
					<?php endif; ?>
				</div>


				<div class="row mt-5">
					<div class="col text-center">
						<div class="block-27">
							<ul>

							</ul>
						</div>

					</div>
				</div>

			</div>
			<div class="col-md-4 col-lg-2">
				<div class="sidebar">
					<div class="sidebar-box-2">
						<h2 class="heading">Brand</h2>
						<div class="fancy-collapse-panel">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Men's Shoes
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<ul>
												<li><a href="#">Sport</a></li>
												<li><a href="#">Casual</a></li>
												<li><a href="#">Running</a></li>
												<li><a href="#">Jordan</a></li>
												<li><a href="#">Soccer</a></li>
												<li><a href="#">Football</a></li>
												<li><a href="#">Lifestyle</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingTwo">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Women's Shoes
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
										<div class="panel-body">
											<ul>
												<li><a href="#">Sport</a></li>
												<li><a href="#">Casual</a></li>
												<li><a href="#">Running</a></li>
												<li><a href="#">Jordan</a></li>
												<li><a href="#">Soccer</a></li>
												<li><a href="#">Football</a></li>
												<li><a href="#">Lifestyle</a></li>
											</ul>
										</div>
									</div>
								</div>
								<!-- <div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingThree">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Accessories
											</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
										<div class="panel-body">
											<ul>
												<li><a href="#">Jeans</a></li>
												<li><a href="#">T-Shirt</a></li>
												<li><a href="#">Jacket</a></li>
												<li><a href="#">Shoes</a></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingFour">
										<h4 class="panel-title">
											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">Clothing
											</a>
										</h4>
									</div>
									<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
										<div class="panel-body">
											<ul>
												<li><a href="#">Jeans</a></li>
												<li><a href="#">T-Shirt</a></li>
												<li><a href="#">Jacket</a></li>
												<li><a href="#">Shoes</a></li>
											</ul>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
					<div class="sorting-options">
						<label for="sort">Sort by:</label>
						<select id="sort" name="sort">
							<option value="price_high_to_low">Price: High to Low</option>
							<option value="price_low_to_high">Price: Low to High</option>
						</select>
						<button onclick="sortProducts()">Sort</button>
					</div>
					<script>
						function sortProducts() {
							var sortBy = document.getElementById("sort").value;
							var productsContainer = document.querySelector(".col-md-8 .row"); // Container chứa sản phẩm
							var products = Array.from(productsContainer.querySelectorAll(".col-sm-12"));
							products.sort(function(a, b) {
								var priceA = parseFloat(a.querySelector(".price span").textContent);
								var priceB = parseFloat(b.querySelector(".price span").textContent);
								if (sortBy === "price_high_to_low") {
									return priceB - priceA; // Sắp xếp từ cao đến thấp
								} else {
									return priceA - priceB; // Sắp xếp từ thấp đến cao
								}
							});
							// Xóa sản phẩm cũ
							productsContainer.innerHTML = '';
							// Thêm lại sản phẩm đã sắp xếp
							products.forEach(function(product) {
								productsContainer.appendChild(product);
							});
						}
					</script>

					<!-- <div class="sidebar-box-2">
						<h2 class="heading">Price Range</h2>
						<form method="post" class="colorlib-form-2" id="price-range-form">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="price_from">Price from:</label>
										<div class="form-field">
											<i class="icon icon-arrow-down3"></i>
											<input type="number" id="price_from" name="price_from">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="price_to">Price to:</label>
										<div class="form-field">
											<i class="icon icon-arrow-down3"></i>
											<input type="number" id="price_to" name="price_to">
										</div>
									</div>
								</div>
							</div>
							<button type="button" id="submit-btn">Submit</button>
						</form>
					</div> -->



					<form method="post">
						<label>Search</label>
						<input type="text" name="search">
						<input class="mt-2" type="submit" name="submit">
					</form>
					<!-- Display search results if available -->
					<script>
						function filterByPriceRange() {
							var minPrice = parseFloat(document.getElementById("price_from").value);
							var maxPrice = parseFloat(document.getElementById("price_to").value);
							var productsContainer = document.querySelector(".col-md-8 .row");
							var products = Array.from(productsContainer.querySelectorAll(".col-sm-12"));
							products.forEach(function(product) {
								var price = parseFloat(product.querySelector(".price span").textContent);
								if ((isNaN(minPrice) || price >= minPrice) && (isNaN(maxPrice) || price <= maxPrice)) {
									product.style.display = "block";
								} else {
									product.style.display = "none";
								}
							});
						}
						document.getElementById("sort-filter-btn").addEventListener("click", function(event) {
							event.preventDefault();
							filterByPriceRange();
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</section>
</body>

</html>
<?php
include("Includes/js.php");
include("Includes/footer.php")
?>