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
                <div class="card">
                    <div class="card-header">
                        <h4>Products</h4>
                    </div>
                    <div class="card-body" id = "products_table">
                        <table class="table table-bordered table-striped">
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
                                    foreach ($products as $items) {
                                ?>
                                        <tr>
                                            <td><?= $items['product_id']; ?></td>
                                            <td><img src="../Assets/<?= $items['image_source']; ?>" width="50px" height="50px" alt=""></td>
                                            <td><?= $items['product_name']; ?></td>
                                            <td><?= $items['product_slug']; ?></td>
                                            <td><?= $items['product_quantity']; ?></td>
                                            <td><?= $items['product_price']; ?></td>
                                            <td><?= $items['product_descriptions']; ?></td>
                                            <td><?= getCategoryName($items['category_id']); ?></td>
                                            <td><?=$items['product_status'] == '1' ? 'Visible' : 'Hidden' ?></td>
                                            <td>
                                                <a href="editProduct.php?id=<?= $items['product_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                            <form action="code.php" method="POST">
                                                    <input type="hidden" name="product_id" value="<?= $items['product_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_product">Delete</button>
                                                </form>                                            </td>
                                        </tr>
                                <?php
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