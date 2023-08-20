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
                        <h4>Add Brand</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="mb-0" for="Name">Name:</label>
                                    <input type="text" name="name" placeholder="Enter Product Name" class="form-control mb-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="mb-0" for="Image">Brand Image:</label>
                                    <input type="file" name="image" multiple id="input-image" class="form-control mb-2">
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="add_brand">Save</button>
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