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

function addProduct($name,$quantity,$price,$description,$category_id){
    $sql = "INSERT INTO product (product_name,product_quantity,product_price,product_descriptions,category_id) VALUES ('$name',$quantity,$price,'$description',$category_id)";
    return execute($sql);
}

function updateProduct($id,$name,$quantity,$price,$description,$category_id){
    $sql = "UPDATE product SET product_name = '$name',product_quantity = $quantity,product_price = $price,product_descriptions = '$description',category_id = $category_id WHERE product_id = $id";
    return execute($sql);
}

?>