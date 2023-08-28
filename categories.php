<?php

include("Functions/userFunction.php");
include("Includes/header.php");


?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.php">Home</a></span> / <span>Category</span></p>
            </div>
        </div>
    </div>
</div>

<div class="py-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1>Our collections</h1>
                <hr>
                <div class="row">
                    <?php
                    $categories = getAllActive("category");

                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $items) {
                    ?>
                    <div class="col-md-4 mb-2">
                        <a href="products.php?category=<?=$items['category_slug'];?>">
                        <div class="card shadow">
                            <div class="card-body">
                                <img src="Assets/<?=$items['category_image'];?>" alt="Category Image" class="w-100">
                            <h4 class ="text-center"><?= $items['category_name'] ?></h4>
                            </div>
                        </div>
                        </a>
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

include("Includes/footer.php");

?>