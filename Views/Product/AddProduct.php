<?php
require_once("../../Controllers/productController.php");
require_once("../../Controllers/categoryController.php");

$name = $quantity = $price = $description = $cateID = '';

$categories = getCategories();

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
        $cateID = $_POST['category_id'];
    }

    addProduct($name,$quantity,$price,$description,$cateID);
    
    if($_FILES['image']){
        $sql = "SELECT max(product_id) as new_product_id from product";
        $new_product_id = executeSingleResult($sql)['new_product_id'];
        uploadImages($_FILES['image'],$new_product_id);
    }
    header('Location: Product.php');
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h1>Add Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?=$name?>">
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?=$quantity?>">
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" value="<?=$price?>">
        <label for="description">Description:</label>
        <textarea name="description" id="" cols="30" rows="10"><?=$description?></textarea>
        <br>
        Category: <select name="category_id" id="">
            <?php 
            foreach($categories as $category){
                echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
            }
            ?>
        </select>
        <br>
        <label for="image">Images:</label>
        <input type="file" name="image[]" multiple id="">
        <input type="submit" value="Add">
    </form>
</body>
</html>
