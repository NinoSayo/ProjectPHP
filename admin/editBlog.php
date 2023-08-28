<?php
session_start();
include("Includes/header.php");
include("../Middleware/admin.php");
include("../Functions/myFunction.php")
?>
<main class="mt-5 pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $blog = getBlogByID($id);

                    if (mysqli_num_rows($blog) > 0) {
                        $data = mysqli_fetch_array($blog);
                ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Blog</h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="blog_id" value="<?= $data['blog_id'] ?>">
                                            <label for="Name">Title:</label>
                                            <input type="text" name="title" value="<?= $data['title'] ?>" placeholder="Enter Title" class="form-control">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="Image">Image:</label>
                                            <input type="file" name="image" class="form-control">
                                            <label for="Image">Current Image:</label>
                                            <input type="hidden" name="old_image" value="<?= $data['image']; ?>">
                                            <img src="../Assets/<?= $data['image']; ?>" height="80px" width="120px" class="mt-3" alt="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Content:</label>
                                            <textarea id="editor" name="content" placeholder="Enter content" class="form-control" cols="30" rows="30"><?= $data['content'] ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="update_blog">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php
                    } else {
                        echo "Blog not found";
                    }
                } else {
                    echo "ID not found!";
                }
                ?>
            </div>
        </div>
</main>
<script>
    CKEDITOR.replace("editor");
    </script>
<?php
include("Includes/footer.php");
?>