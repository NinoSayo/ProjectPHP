<?php
require_once("../../Controllers/categoryController.php");
require_once("../../Controllers/productController.php");

$id = $name = $quantity = $price = $description = $image = $cateID = '';

$categories = getCategories();

if(isset($_GET['product_id'])){
    $id = $_GET['product_id'];
    $product = getProductsByID($id);
    $name = $product['product_name'];
    $quantity = $product['product_quantity'];
    $price = $product['product_price'];
    $description = $product['product_descriptions'];
    $cateID = $product['category_id'];
}

if(isset($_POST) && !empty($_POST)){
    if(isset($_POST['name'],$_POST['quantity'],$_POST['price'],$_POST['category'])){
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $cateID = $_POST['category'];
    }

    if($id == ''){
        addProduct($name,$quantity,$price,$description,$cateID);
    }else{
        updateProduct($id,$name,$quantity,$price,$description,$cateID);
    }
    
    header("Location Product.php");
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
    <form action="" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name">
        <br>
        <label for="quantity">Quanity</label>
        <input type="number" name="quantity" id="">
        <br>
        <label for="price">Price</label>
        <input type="number" name="price" id="">
        Category: <select name="category" id="">
            <?php
            foreach ($categories as $category){
                if($category['category_id'] == $cateID){
                echo '<option selected value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
            }else{
                echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
            }
        }
            ?>
        </select>
        <br>
        Description: <textarea name="description" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Add">
    </form>
</body>
</html>