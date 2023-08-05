<?php
session_start();
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

function getCartItems(){
    global $con;
    $userID =  $_SESSION['auth_user']['id'];
    $sql = "SELECT c.cart_id as cid, c.product_id as pid, c.product_qty , p.product_name, p.product_quantity , p.product_price, pi.image_source, cat.category_name
    FROM carts c
    JOIN product p ON c.product_id = p.product_id
    JOIN product_image pi ON p.product_id = pi.product_id
    JOIN category cat on p.category_id = cat.category_id
    WHERE user_id = '$userID'
    ORDER BY c.cart_id DESC";
    
    return mysqli_query($con,$sql);
}

function getOrderDetails(){
    global $con;
    $userID = $_SESSION['auth_user']['id'];

    $sql = "SELECT o.order_id, oi.item_qty, oi.item_price, p.product_name, o.payment_method, o.create_at, o.total_price, o.order_status, o.shipping_firstname, o.shipping_lastname, o.shipping_phone, o.shipping_email, o.shipping_country, o.shipping_address, o.shipping_city, o.shipping_pin
    FROM orders o
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN product p ON oi.product_id = p.product_id
    WHERE o.user_id = '$userID'
    ORDER BY o.create_at DESC";
    return mysqli_query($con,$sql);
}
?>