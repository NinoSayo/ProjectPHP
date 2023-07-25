<?php
require_once("../../Controllers/categoryController.php");

$id = $name = $description = $image = '';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $categories = getCategoriesByID($id);
        $name = $categories['category_name'];
        $description = $categories['category_descriptions'];
        $image = $categories['category_image'];
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
            $imagePath = "../../Assets/Images/category/".basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'],$imagePath);
        }

        if($id == ''){
            addCategory($name,$image,$description);
        }else{
            updateCategory($id,$name,$image,$description);        
        }

        header("Location: Category.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form action="" method = "POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?=$name?>" required>
        <br>
        <label for="image">Category Image:</label>
        <input type="file" name="image" id="input-image"><br>
        <?php
        if($image != ''){
            echo '<img src="../../Assets/'.$image.'" width="100px" height="100px" id="image-preview">';
        } else {
            echo '<img src="" width="100px" height="100px" id="image-preview" style="display: none;">';
        }
        ?>
        <br>
        <label for="description"></label>
        <textarea name="description" id="" cols="30" rows="10"><?=$description?></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>
    <script src="../../Assets/JS/PreviewImages.js"></script>
</body>
</html>