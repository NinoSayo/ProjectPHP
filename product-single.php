<?php

include("Functions/userFunction.php");
include("Includes/header.php");

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $productData = getSlugActive('product', $product_slug, 'product_slug', 'product_status');
    $product = mysqli_fetch_array($productData);

    if ($product) {
?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.php">Home</a></span> / <span>Collection / <?=$product['product_name'];?></span></p>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <?php
                            // Retrieve all image sources associated with the product
                            $product_id = $product['product_id'];
                            $product_images = getProductsWithImages($product_id);
                            foreach ($product_images as $image) {
                            ?>
                                <img src="Assets/<?= $image['image_source'] ?>" class="w-100" alt="">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['product_name']; ?></h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>$<?= $product['product_price'] ?></h5>
                                <h5 class="text-muted" style="font-size:17px">Items in stock : <?=$product['product_quantity'];?></h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 130px">
                                    <Button class="input-group-text decrement-btn "><i class="ion-ios-remove"></i></Button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <Button class="input-group-text increment-btn"><i class="ion-ios-add"></i></Button>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-6">
                            <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                <button class="btn btn-black py-3 px-5 mr-2 addToCart-btn " value="<?=$product['product_id']?>"><i class="bi bi-cart-plus-fill me-2"></i>Add to cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"><i class="bi bi-heart me-2"></i>Wishlist</button>
                            </div>
                        </div>
                        <hr>
                        <h6>Product description:</h6>
                        <p><?= $product['product_descriptions']; ?></p>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "Product not found";
    }
} else {
    echo "Something went wrong";
}

include("Includes/footer.php");
