<?php
session_start();
include("../Middleware/admin.php");
include("Includes/header.php");
?>
<main class="mt-2 pt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-theme bg-dark shadow-lg">
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
                                    <label for="Name">Tags:</label>
                                    <input type="text" name="slug" placeholder="Enter tag " class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="Image">Category Image:</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="Status">Status:</label>
                                    <input type="checkbox">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="">Description:</label>
                                    <textarea name="description" placeholder="Enter description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <input type="hidden" name="status" value="0">
                                <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const saveButton = document.querySelector("[name='save_category']");
        const categoryNamePlaceholder = document.getElementById("categoryNamePlaceholder");

        saveButton.addEventListener("click", function(event) {
            event.preventDefault();

            // Check if the required fields are filled
            const nameField = document.querySelector("[name='name']").value;
            const tagField = document.querySelector("[name='slug']").value;
            const imageField = document.querySelector("[name='image']").value;

            if (nameField === "" || tagField === "" || imageField === "") {
                alertify.error("Please fill out all required fields before saving.");
            }
        })
    });
</script>


<?php
include("Includes/footer.php");
?>