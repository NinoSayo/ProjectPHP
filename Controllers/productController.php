<?php
require_once("../../Database/Connect.php");

function getProducts(){
    $sql = "SELECT * FROM product";
    return executeResult($sql);
}

function getProductsByID($id){
    $sql = "SELECT * FROM product WHERE product_id = $id";
    return executeSingleResult($sql);
}

function addProduct($name,$quantity,$price,$description,$cateID){
   $sql = "INSERT INTO product(product_name,product_quantity,product_price,product_descriptions,category_id) VALUES ( '$name' , $quantity , $price , $description , $cateID )";
   return execute($sql);
}

function updateProduct($id,$name,$quantity,$price,$description,$cateID){
    $sql = "UPDATE product SET product_name = '$name',product_quantity = $quantity , product_price = $price , product_descriptions = '$description' , category_id = $cateID WHERE product_id = $id";
    return execute($sql);
}

function deleteProduct($id){
    $products = getProductsByID($id);

    if($products && !empty($products)){
        $imagePath = "../../Assets/".$products['product_image'];
        if(file_exists($imagePath) && is_file($imagePath)){
            unlink ($imagePath);
        }
        $sql = "DELETE FROM product WHERE product_id = $id";
        return execute($sql);
    }else{
        return false;
    }

}

?>