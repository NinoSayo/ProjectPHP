<?php

function addImageProduct($product_name, $image_name, $product_id) {
    $sql = "INSERT INTO product_image (product_name, image_name, product_id) VALUES ('$product_name', '$image_name', $product_id)";
    return execute($sql);
}


?>