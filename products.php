<?php

include("Functions/userFunction.php");
include("Includes/header.php");

if(isset($_GET['category'])){

$category_slug = $_GET['category'];
$categoryData = getSlugActive('category',$category_slug,'category_slug','category_status');
$category = mysqli_fetch_array($categoryData);

if($category){
    $cid = $category['category_id'];
    ?>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span></p>
				<h1 class="mb-0 bread">Product</h1>
			</div>
		</div>
	</div>
</div>

    <div class="py-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><?=$category['category_name'];?></h1>
                    <hr>
                    <div class="row">
                        <?php
                        $products = getProductByCategory($cid);
    
                        if (mysqli_num_rows($products) > 0) {
                            foreach ($products as $items) {
                        ?>
                        <div class="col-md-4 mb-2">
                            <a href="productsView.php?product=<?= $items['product_slug'] ?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="Assets/<?=$items['image_source'];?>" alt="Product Image" class="w-100">
                                <h4 class ="text-center"><?= $items['product_name'] ?></h4>
                                </div>
                            </div>
                        </div>
                                
                        <?php
                            }
                        } else {
                            echo "No data available";
                        }
                        ?>
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
    <?php
}else{
    echo "Something went wrong";
}

}
else{
    echo "Something went wrong";
}
include("Includes/footer.php");

?>