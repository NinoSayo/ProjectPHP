<?php
session_start();
include("Includes/header.php");
include("../Middleware/admin.php");
?>
<main class="mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="Name">Name:</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="Image">Category Image:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Description:</label>
                                <textarea name="description" placeholder="Enter description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class= "btn btn-primary" name="add_category">Save</button>
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