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

    updateProduct($id, $name, $quantity, $price, $description, $category_id);
    header("Location: Product.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        <input type="number" name="price" value="<?=$price?>">
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
        <input type="submit" value="Update">
    </form>
</body>
</html>
