<?php 
require_once("../../Controllers/productController.php");
require_once("../../Controllers/categoryController.php");

$products = getProducts();
$categories = getCategories();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="AddProduct.php">Add Product</a>
    <div>
        <?php
        if(!empty($products)){
        ?>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            <?php
            foreach($products as $product){
            ?>
            <tr>
                <td>
                    <!-- <img src="../../Assets/<?=$product['product_image']?>" width="100px" height="100px"> -->
                </td>
                <td><?=$product['product_name']?></td>
                <td><?=$product['product_quantity']?></td>
                <td><?=$product['product_price']?></td>
                <td>
                    <?php 
                    foreach($categories as $category){
                        if($category['category_id'] == $product['category_id']){
                            echo $category['category_name'];
                            break;
                        }
                    }
                    ?>
                </td>
                <td>
                <a href="AddProduct.php?id=<?=$product['product_id'];?>" class="edit-link">Edit</a> |
                <a href="#" class="delete-link" data-id="<?= $product['product_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php 
            }
            ?>
        </table>
        <?php
        }else{
            echo '<p style="color:red">No Data Found!</p>';
        }
        ?>
    </div>
    <script src="../../Assets/JS/DeleteProduct.js"></script>
</body>
</html>