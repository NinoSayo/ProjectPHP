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
                        <h4>Add Blog</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="Name">Title:</label>
                                <input type="text" name="title" placeholder="Enter Blog Title" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="Image">Image:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="">Content:</label>
                                <textarea id="editor" name="content" placeholder="Enter content" class="form-control" cols="30" rows="30"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class= "btn btn-primary" name="add_blog">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</main>
<script>
    CKEDITOR.replace("editor");
    </script>
   
<?php
include("Includes/footer.php");
?>