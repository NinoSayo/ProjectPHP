<?php
session_start();
include("Includes/header.php");
include("../Middleware/admin.php");
include("../Functions/myFunction.php");

if (isset($_GET['id']) && isset($_GET['image_id'])) {
    $id = $_GET['id'];
    $image_id = $_GET['image_id'];
    $products = getProductsWithImages($id);

    if (count($products) > 0) {
        $data = null;
        foreach ($products as $product) {
            if ($product['image_id'] == $image_id) {
                $data = $product;
                break;
            }
        }

        if ($data) {
            if (isset($_POST['update_product'])) {
            }
?>
            <main class="mt-3 pt-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-theme bg-dark shadow-lg">
                                <div class="card-header">
                                    <h4>Edit Product</h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                                                <input type="hidden" name="image_id" value="<?= $data['image_id'] ?>">
                                                <label class="mb-0" for="Name">Name:</label>
                                                <input type="text" name="name" value="<?= $data['product_name'] ?>" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0" for="Slug">Slug:</label>
                                                <input type="text" name="slug" value="<?= $data['product_slug'] ?>" class="form-control mb-2">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-0" for="Image">Product Image:</label>
                                                <input type="file" name="image[]" multiple id="input-image" class="form-control mb-2">
                                                <label for="">Current Images:</label>
                                                <?php
                                                // $images = getAll('product_image');
                                                // if (mysqli_num_rows($images) > 0) {
                                                    $images = getProductsWithImages($id);
                                                    foreach($images as $image){
                                                        if ($image['product_id'] == $id)
                                                ?>
                                                        <div>
                                                            <input type="hidden" name="old_images[]" value="<?= $image['image_id']; ?>" id = "image_<?=$image['image_id'];?>">
                                                            <img src="../Assets/<?= $image['image_source']; ?>" height="50px" width="50px">
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                            </div>
                                            <div class="col-md-6 py-2">
                                                <label for="Status">Status:</label>
                                                <input type="radio" name="status" value="1" <?php if ($data['product_status'] == 1) echo 'checked' ?>> Put on store
                                                <input type="radio" name="status" value="0" <?php if ($data['product_status'] == 0) echo 'checked' ?>> Hidden
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
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

<?php
                                                
                                            }
                                        } else {
                                            echo "Product not found";
                                        }
                                    } else {
                                        echo "ID not provided";
                                    }

                                    include("Includes/footer.php");
?>