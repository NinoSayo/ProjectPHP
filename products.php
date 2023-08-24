<?php

include("Functions/userFunction.php");
include("Includes/header.php");

if(isset($_GET['category'])){

$category_slug = $_GET['category'];
$categoryData = getSlugActive('category',$category_slug,'category_slug','category_status');
$category= mysqli_fetch_array($categoryData);

if($category){
    $cid = $category['category_id'];
    ?>

    <div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.php">Home</a></span> / <span>Collection / <?=$category['category_name'];?></span></p>
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