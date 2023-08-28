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
            LEFT JOIN product_image ON product.product_id = product_image.product_id";

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
function getBlogLimited($startIndex, $blogsPerPage)
{
    global $con;
    $sql = "SELECT * FROM blog
     ORDER BY created_at DESC
     LIMIT $startIndex, $blogsPerPage";
    $result = mysqli_query($con, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function getRecentBlogs() {
    global $con; 
    $query = "SELECT * FROM blog ORDER BY created_at DESC LIMIT 4"; // Lấy 3 bài gần đây
    $result = $con->query($query);
    $recentBlogs = $result->fetch_all(MYSQLI_ASSOC);

    return $recentBlogs;
}
function getBlogDetail($blog_id) {
    global $con; 

    $query = "SELECT * FROM blog WHERE blog_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $blogDetail = $result->fetch_assoc();

    return $blogDetail;
}

function countBlogs() {
    global $con; 

    $query = "SELECT COUNT(*) as total FROM blog";
    
    $result = $con->query($query);
    $row = $result->fetch_assoc();

    return $row['total'];
}
function getCartItems() {
    global $con;
    $userID = $_SESSION['auth_user']['id'];
    $sql = "SELECT c.cart_id as cid, c.product_id as pid, c.product_qty , p.product_name, p.product_quantity , p.product_price, pi.image_source, cat.category_name
    FROM carts c
    JOIN product p ON c.product_id = p.product_id
    JOIN (
        SELECT pi1.product_id, MIN(pi1.image_id) as min_image_id
        FROM product_image pi1
        GROUP BY pi1.product_id
    ) pi_min ON p.product_id = pi_min.product_id
    JOIN product_image pi ON pi_min.min_image_id = pi.image_id
    JOIN category cat on p.category_id = cat.category_id
    WHERE user_id = '$userID'
    ORDER BY c.cart_id DESC";

    return mysqli_query($con, $sql);
}

function getUserDetails(){
    global $con;
    $userID = $_SESSION['auth_user']['id'];

    $sql = "SELECT * FROM users WHERE id = '$userID'";
    return mysqli_query($con,$sql);
}


function getOrderDetails(){
    global $con;
    $userID = $_SESSION['auth_user']['id'];

    $sql = "SELECT * , DATE(o.create_at) AS order_date
    FROM orders o
    WHERE o.user_id = '$userID'
    ORDER BY o.create_at DESC";
    return mysqli_query($con,$sql);
    
}

function getOrderbyID($id)
{
    global $con;
    $sql = "SELECT * FROM orders o
    JOIN order_items oi on o.order_id = oi.order_id
    JOIN product p on oi.product_id = p.product_id
    LEFT JOIN product_image pi on oi.product_id = pi.product_id
    WHERE o.order_id = '$id'";
    return $run = mysqli_query($con, $sql);
}

function CheckValid($OrderNO){
    global $con;
    $userID = $_SESSION['auth_user']['id'];

    $sql = "SELECT * FROM orders WHERE Order_NO = '$OrderNO' and user_id = '$userID'";
    
    return mysqli_query($con,$sql);
}

function searchProducts($searchTerm)
{
    global $con;

    // Prepare the SQL query
    $query = "SELECT *
              FROM product
              INNER JOIN product_image ON product.product_id = product_image.product_id 
              WHERE product.product_name LIKE ?";
    $searchTerm = '%' . $searchTerm . '%';

    // Prepare and bind the parameters
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $searchTerm);

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Fetch all rows as associative arrays
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}
