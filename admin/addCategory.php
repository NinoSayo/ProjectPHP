<?php
session_start();
include("../Middleware/admin.php");
include("Includes/header.php");
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
                                    <label for="Name">Tags:</label>
                                    <input type="text" name="slug" placeholder="Enter tag " class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="Image">Category Image:</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="">Description:</label>
                                    <textarea name="description" placeholder="Enter description" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                                <input type="hidden" name="status" value="0">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" name="save_category" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        </div>
                        <div class="modal-body">
                            Do you want to put <span id='categoryNamePlaceholder'></span> on the store?
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Keep hiding</button>
                            <button type="submit" class="btn btn-primary">Put on the store</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                    } else {
                        categoryNamePlaceholder.textContent = nameField;
                        console.log(nameField);

                        const modal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                        modal.show();
                    }
                });
            });
        </script>




</main>


<?php
include("Includes/footer.php");
?>


<button type="submit" class="btn btn-primary" name="add_category">Save</button>