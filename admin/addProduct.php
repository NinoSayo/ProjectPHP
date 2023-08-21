<?php
session_start();
include("../Middleware/admin.php");
include("../Functions/myFunction.php");
include("Includes/header.php");
?>
<main class="mt-2 pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-theme bg-dark shadow-lg">
                    <div class="card-header">
                        <h4>Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0" for="Name">Name:</label>
                                    <input type="text" name="name" placeholder="Enter Product Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="Slug">Slug:</label>
                                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="Image">Product Image:</label>
                                    <input type="file" name="image[]" multiple id="input-image" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Quantity:</label>
                                    <input type="number" name="quantity" placeholder="Enter quantity" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="">Price:</label>
                                    <input type="number" step="0.01" name="price" placeholder="Enter price" class="form-control mb-2">
                                </div>
                                <div class="col-md-12">
                                <label class="mb-0">Description:</label>
                                <textarea name="description" placeholder="Enter description" class="form-control mb-2" cols="30" rows="9"></textarea>
                            </div>
                                <div class="col-md-6">
                                    <label class="mb-2" for="Image">Category:</label>
                                    <select name = "category_id" class="form-select mb-2" required>
                                        <option selected>Select Category</option>
                                        <?php
                                        $categories = getAll("category");
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $items) {
                                        ?>
                                                <option value="<?= $items['category_id']; ?>"><?= $items['category_name']; ?></option>
                                        <?php
                                            }
                                        }else{
                                            echo "No category available";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                <label for="">Status</label>
                                <input type="checkbox" name="status" id="">
                            </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="add_product">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php
include("Includes/footer.php");
?>