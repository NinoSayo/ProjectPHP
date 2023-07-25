<?php
require_once("../../Controllers/productController.php");
require_once("../../Controllers/categoryController.php");

$id = $name = $quantity = $price = $description = $category_id = '';

$categories = getCategories();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $products = getProductsByID($id);
    $name = $products['product_name'];
    $quantity = $products['product_quantity'];
    $price = $products['product_price'];
    $description = $products['product_descriptions'];
    $category_id = $products['category_id'];
    $imageURL = $products['image_source'];
}

if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    if(isset($_POST['quantity'])){
        $quantity = $_POST['quantity'];
    }
    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }
    if(isset($_POST['category_id'])){
        $category_id = $_POST['category_id'];
    }
    if(!empty($_FILES['image'])){
        updateImage($id,$name,$quantity,$price,$description,$category_id,$_FILES['image']);
    }else{
        updateImage($id,$name,$quantity,$price,$description,$category_id,[]);
    }



    header("Location: Product.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <script src="../../Assets/JS/jquery-3.7.min.js"></script>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?=$name?>">
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?=$quantity?>">
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?=$price?>"><br>
        <label for="description">Description:</label>
        <textarea name="description" id="" cols="30" rows="10"><?=$description?></textarea>
        <br>
        Category: <select name="category_id" id="">
            <?php 
            foreach($categories as $category){
                if($category['category_id'] == $category_id){
                    echo '<option selected value ="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                }else{
                    echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                }
            }
          ?>
          </select>
          <br>
        <label for="image">Image:</label>
        <input type="file" name="image[]" multiple id="input-image">
        <br>
        <img id="image-preview" src="<?=!empty($imageURL) ? "../../Assets/".$imageURL : ""?>" width="100" height="100" style="<?=empty($imageURL) ? "display: none;" : "";?>"><br>
        <input type="submit" value="Update">
    </form>
    <script src="../../Assets/JS/PreviewImages.js"></script>
</body>
</html>
