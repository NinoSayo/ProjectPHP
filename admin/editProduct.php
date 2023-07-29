<?php
session_start();
include("Includes/header.php");
include("../Middleware/admin.php");
include("../Functions/myFunction.php");
?>
<main class="mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $products = getProductsWithImages($id);

                    if (count($products) > 0) {
                        foreach ($products as $data) {
                ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Product</h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                                                <label class="mb-0" for="Name">Name:</label>
                                                <input type="text" name="name" value="<?= $data['product_name'] ?>" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0" for="Image">Product Image:</label>
                                                <input type="file" name="image[]" multiple id="input-image" class="form-control mb-2">
                                                <label for="">Current Image:</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image_source']; ?>">
                                                <img src="../Assets/<?= $data['image_source']; ?>" height="50px" width="50px" alt="">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0" for="">Quantity:</label>
                                                <input type="number" name="quantity" value="<?= $data['product_quantity'] ?>" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0" for="">Price:</label>
                                                <input type="number" step="0.01" name="price" value="<?= $data['product_price'] ?>" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="mb-0">Description:</label>
                                                <textarea name="description" placeholder="Enter description" class="form-control mb-2" cols="30" rows="10"><?= $data['product_descriptions'] ?></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-2" for="Image">Category:</label>
                                                <select name="category_id" class="form-select mb-2" required>
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    $categories = getAll("category");
                                                    if (mysqli_num_rows($categories) > 0) {
                                                        while ($category = mysqli_fetch_assoc($categories)) {
                                                            $selected = ($category['category_id'] == $data['category_id']) ? "selected" : "";
                                                    ?>
                                                            <option value="<?= $category['category_id']; ?>" <?= $selected; ?>><?= $category['category_name']; ?></option>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "No category available";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" name="update_product">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        echo "Product not found";
                    }
                } else {
                    echo "ID not provided";
                }
                ?>
            </div>
        </div>
</main>

<?php
include("Includes/footer.php");
?>