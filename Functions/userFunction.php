<?php
include("Database/Connect.php");

function getAllActive($table)
{
    global $con;
    $sql = "SELECT * FROM $table WHERE category_status = '1'";
    return $run = mysqli_query($con, $sql);
}

function getIDActive($table, $id)
{
    global $con;
    $sql = "SELECT * FROM $table WHERE category_id = '$id' and category_status = '1'";
    return $run = mysqli_query($con, $sql);
}

function getSlugActive($table, $slug,$slugColumnName,$statusColumnName)
{
    global $con;
    $sql = "SELECT * FROM $table WHERE $slugColumnName = '$slug' and $statusColumnName  = '1' LIMIT 1";
    return $run = mysqli_query($con, $sql);
}

function getProductByCategory($category_id){
    global $con;
    $sql = "SELECT p.*, pi.image_source 
            FROM product AS p 
            LEFT JOIN product_image AS pi ON p.product_id = pi.product_id 
            WHERE p.category_id = '$category_id' AND p.product_status = '1' 
            GROUP BY p.product_id";
    return $run = mysqli_query($con, $sql);
}

function getProductsWithImages($product_id = null)
{
    global $con;
    $sql = "SELECT product.product_id, product.product_name, product.product_slug ,product.product_quantity, product.product_price, product.product_status,product.product_descriptions, product.category_id, product_image.image_source
            FROM product
            INNER JOIN product_image ON product.product_id = product_image.product_id";

    if ($product_id !== null) {
        $product_id = mysqli_real_escape_string($con, $product_id);
        $sql .= " WHERE product.product_id = '$product_id'";
    }

    $result = mysqli_query($con, $sql);

    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}
?>