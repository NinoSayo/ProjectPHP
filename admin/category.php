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
            <div class="card card-theme bg-dark shadow-lg">
                    <div class="card-header">
                        <h4>Categories</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped text-white">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $category = getAll("category");
                                if (mysqli_num_rows($category) > 0) {
                                    foreach ($category as $items) {
                                ?>
                                        <tr>
                                            <td><?= $items['category_id']; ?></td>
                                            <td><img src="../Assets/<?= $items['category_image']; ?>" width="50px" height="50px" alt=""></td>
                                            <td><?= $items['category_name']; ?></td>
                                            <td><?= $items['category_slug']; ?></td>
                                            <td><?= $items['category_descriptions']; ?></td>
                                            <td><?=$items['category_status'] == '1' ? 'Visible' : 'Hidden' ?></td>
                                            <td>
                                                <a href="editCategory.php?id=<?= $items['category_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                            </td>
                                            <td>
                                            <form action="code.php" method="POST">
                                                    <input type="hidden" name="category_id" value="<?= $items['category_id']; ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" name="delete_category">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
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