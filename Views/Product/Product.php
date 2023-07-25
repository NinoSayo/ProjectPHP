<?php
require_once("../../Controllers/productController.php");
require_once("../../Controllers/categoryController.php");

$products = getProducts();
$categories = getCategories();

function limitDescription($description, $maxLength)
{
    if (strlen($description) > $maxLength) {
        $description = substr($description, 0, $maxLength) . '...';
    }
    return $description;
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
    <a href="AddProduct.php">Add Product</a>
    <div>
        <?php
        if (!empty($products)) {
        ?>
            <table border="1">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Descriptions:</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($products as $product) {
                ?>
                    <tr>
                        <td>
                            <img src="../../Assets/<?= $product['image_source'] ?>" width="100px" height="100px">
                        </td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['product_quantity'] ?></td>
                        <td><?= $product['product_price'] ?></td>
                        <td><?= limitDescription($product['product_descriptions'], 20) ?></td>
                        <td>
                            <?php
                            foreach ($categories as $category) {
                                if ($category['category_id'] == $product['category_id']) {
                                    echo $category['category_name'];
                                    break;
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <a href="EditProduct.php?id=<?= $product['product_id']; ?>" >Edit</a> |
                            <a href="#" onclick="deleteProduct(<?=$product['product_id']?>)">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php
        } else {
            echo '<p style="color:red">No Data Found!</p>';
        }
        ?>
    </div>
</body>
<script>
    function deleteProduct(id){
    var option = confirm("do you want to delete?" + id);
    if(!option){
        return;
    }
    //ajax
    $.post('../../Views/product/DeleteProduct.php',{
        'id' : id 
    }, function(data){
        location.reload();
    })
}
</script>
</html>