<?php
require_once("../../Controllers/categoryController.php");


$id = $name = $description = $image = "";

$id = isset($_GET['id']) ? intval($_GET['id']) : null;



if ($id !== null) {
    $category = getCategoriesByID($id);

    if ($category) {
        $name = $category['name'];
        $description = $category['description'];
        $image = $category['image'];
    }
}
if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }
    if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
        $image = "Images/category/".basename($_FILES['image']['name']);
        $imageLink = "../../Assets/Images/category/".basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],$imageLink);
    }

    if($id == ''){
        addCategory($name, $image, $description);
    }
    header("Location: Category.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Category</title>
</head>

<body>
    <h1>Create New Category</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?=$name?>" required>
        <br>
        <label for="image">Category Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <?php
        if($image != ''){
            echo '<img src="../../Assets/<?= $category["category_image"] ?>" width="100px" height="100px">';
        }
        ?>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"  value="<?=$description?>" required></textarea>
        <br>
        <input type="submit" value="Create Category">
    </form>
</body>

</html>
