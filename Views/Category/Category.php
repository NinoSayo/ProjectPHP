   <?php
   require_once("../../Controllers/categoryController.php");

   $categories = getCategories();

   ?>
   <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>
        <a href="AddCategory.php">Add category</a>
        <div>
            <?php
            if (!empty($categories)) {
            ?>
                <table border="1">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Descriptions</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <tr>
                            <td>
                            <img src="../../Assets/<?= $category['category_image'] ?>" width="100px" height="100px">
                            </td>
                            <td><?= $category['category_name'] ?></td>
                            <td><?= $category['category_descriptions'] ?></td>
                            <td>
                            <a href="AddCategory.php?id=<?=$category['category_id'];?>" class="edit-link">Edit</a> |
                                <a href="#" class="delete-link" data-id="<?= $category['category_id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else {
                echo '<p style="color:red">No Data Found</p>';
            } ?>
        </div>
        <script src="../../Assets/JS/DeleteCategory.js"></script>
    </body>

    </html>