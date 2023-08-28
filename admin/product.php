<?php
session_start();
include("../Functions/myFunction.php");
include("../Middleware/admin.php");
include("Includes/header.php");
?>
<main class="mt-5 pt-5 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-theme bg-dark shadow-lg">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body" id="products_table">
                        <table class="table table-bordered text-white">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $products = getProductsWithImages();
                                if (count($products) > 0) {
                                    $previousProductId = null; // Keep track of the previous product ID

                                    foreach ($products as $product) {
                                        if ($previousProductId !== $product['product_id']) {
                                            // Display product information
                                ?>
                                            <tr>
                                                <td><?= $product['product_id']; ?></td>
                                                <td>
                                                    <?php
                                                    // Display images for the current product
                                                    $productImages = getProductImages($product['product_id']);
                                                    foreach ($productImages as $image) {
                                                        echo '<img src="../Assets/' . $image['image_source'] . '" width="50px" height="50px" alt="">';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- Display other product data -->
                                                <td><?= $product['product_name']; ?></td>
                                                <td><?= $product['product_slug']; ?></td>
                                                <td><?= $product['product_quantity']; ?></td>
                                                <td><?= $product['product_price']; ?></td>
                                                <td><?= $product['product_descriptions']; ?></td>
                                                <td><?= getCategoryName($product['category_id']); ?></td>
                                                <td><?= $product['product_status'] == '1' ? 'Visible' : 'Hidden' ?></td>
                                                <td>
                                                    <a href="editProduct.php?id=<?= $product['product_id']; ?>&image_id=<?= $product['image_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger" name="delete_product">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                <?php
                                            $previousProductId = $product['product_id'];
                                        }
                                    }
                                } else {
                                    echo "No record found";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
include("Includes/footer.php");
?>