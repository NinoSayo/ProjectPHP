<?php

include("Functions/userFunction.php");
include("Includes/header.php");


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

<div class="py-2">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <hr>
                <div class="row">
                    <?php
                    $categories = getAllActive("category");

                    if (mysqli_num_rows($categories) > 0) {
                        foreach ($categories as $items) {
                    ?>
                    <div class="col-md-4 mb-2">
                        <a href="products.php?category=<?=$items['category_slug'];?>">
                        <div class="card ">
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