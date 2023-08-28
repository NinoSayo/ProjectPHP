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
                        <h4>Blogs</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $blog = getAll("blog");
                                if (mysqli_num_rows($blog) > 0) {
                                    foreach ($blog as $items) {
                                         $idModelDes = "exampleModalDes".$items["blog_id"] ;
                                ?>
                                        <tr>
                                            <td><?= $items['blog_id']; ?></td>
                                            <td><img src="../Assets/<?= $items['image']; ?>" width="150px" height="100px" alt=""></td>
                                            <td><?= $items['title']; ?></td>
                                            <td>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDes ?>">
                                                View</a>
                                            </td>
                                            <td><?= $items['created_at']; ?></td>
                                            <td>
                                                <a href="editBlog.php?id=<?= $items['blog_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                            <form action="code.php" method="POST">
                                                    <input type="hidden" name="blog_id" value="<?= $items['blog_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_blog">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!--Des-->
                                            <div class="modal fade" id="<?php echo $idModelDes ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $items["title"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <?php echo $items["content"] ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Dele-->
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