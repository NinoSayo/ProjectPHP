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
                    $category = getByID("category", $id);

                    if (mysqli_num_rows($category) > 0) 
                    {
                        $data = mysqli_fetch_array($category);
                ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Category</h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name = "category_id" value="<?=$data['category_id']?>">
                                            <label for="Name">Name:</label>
                                            <input type="text" name="name" value="<?=$data['category_name']?>" placeholder="Enter Category Name" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Image">Category Image:</label>
                                            <input type="file" name="image" class="form-control">
                                            <label for="Image">Current Image:</label>
                                            <input type="hidden" name = "old_image" value="<?=$data['category_image'];?>">
                                            <img src="../Assets/<?=$data['category_image'];?>" height="50px" width="50px" alt="">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">Description:</label>
                                            <textarea name="description" placeholder="Enter description" class="form-control" cols="30" rows="10"><?=$data['category_descriptions']?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" name="update_category">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php
                    }else{
                        echo "Category not found";
                    }
                } else {
                    echo "ID not found!";
                }
                ?>
            </div>
        </div>
</main>

<?php
include("Includes/footer.php");
?>