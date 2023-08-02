<?php

include("Functions/userFunction.php");
include("Includes/header.php");


?>

<div class ="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">Home / Collection</h6>
    </div>
</div>

<div class="py-5">
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