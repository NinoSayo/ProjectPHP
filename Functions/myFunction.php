<?php

include("../Database/Connect.php");

function getAll($table)
{
    global $con;
    $sql = "SELECT * FROM $table";
    return $run = mysqli_query($con, $sql);
}

function getByID($table, $id)
{
    global $con;
    $sql = "SELECT * FROM $table WHERE category_id = '$id'";
    return $run = mysqli_query($con, $sql);
}

function uploadImages($images, $product_id, $con) {
    $image_sources = array();

    // Loop through each uploaded image
    foreach ($images['tmp_name'] as $index => $tmp_name) {
        $image_name = $images['name'][$index];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = "product_" . uniqid() . "." . $image_extension;

        $image_path = "../Assets/Images/product/" . $image_new_name;
        move_uploaded_file($tmp_name, $image_path);

        // Save the image source to the array
        $image_sources[] = "Images/product/" . $image_new_name;
    }

    // Insert the image sources into the 'product_image' table using prepared statement
    $stmt = $con->prepare("INSERT INTO product_image (product_id, image_source) VALUES (?, ?)");

    // Bind parameters inside the foreach loop and execute the statement for each image source
    foreach ($image_sources as $image_source) {
        $stmt->bind_param("is", $product_id, $image_source);
        $stmt->execute();
    }

    $stmt->close();
}



function validateUploadFile($file, $uploadPath)
{
    if ($file['size'] > 2 * 1024 * 1024) { // max upload = 2mb
        return false;
    }
    $validTypes = array("jpg", "jpeg", "png", "bmp");
    $fileType = substr($file['name'], strrpos($file['name'], ".") + 1);
    if (!in_array($fileType, $validTypes)) {
        return false;
    }
    $num = 1;
    $fileNamecheck = substr($file['name'], 0, strrpos($file['name'], "."));
    $fileName = $fileNamecheck;
    while (file_exists($uploadPath . '/' . $fileName . "." . $fileType)) {
        $fileName = $fileNamecheck . "(" . $num . ")";
        $num++;
    }
    $file['name'] = $fileName . '.' . $fileType;
    return $file;
}

// myFunction.php

function getProductsWithImages($product_id = null)
{
    global $con;
    $sql = "SELECT product.product_id, product.product_name, product.product_quantity, product.product_price, product.product_descriptions, product.category_id, product_image.image_source
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

function associateProductImage($product_id, $image_filename, $con) {
    $sql = "INSERT INTO product_image (product_id, image_source) VALUES ('$product_id', '$image_filename')";
    mysqli_query($con, $sql);
}

function getCategoryName($category_id) {
    global $con;

    $sql = "SELECT category_name FROM category WHERE category_id = '$category_id'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['category_name'];
    } else {
        return "Uncategorized";
    }
}
?>