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

function addProduct($name,$quantity,$price,$cateID){
   $sql = "INSERT INTO product(product_name,product_quantity,product,product_price,category_id) VALUES ( '$name' , $quantity , $price , $cateID )";
   return execute($sql);
}

function updateProduct($id,$name,$quantity,$price){
    $sql = "UPDATE product SET product_name = '$name',product_quantity = $quantity,product_price = $price WHERE product_id = $id";
    return execute($sql);
}

function deleteProduct($id){
    $sql = "DELETE FROM product WHERE product_id = $id";
    return execute($sql);
}

?>