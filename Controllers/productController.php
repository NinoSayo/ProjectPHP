<?php
require_once("../../Database/Connect.php");

function getProducts(){
    $sql = "SELECT p.*, pi.image_source 
            FROM product p 
            INNER JOIN product_image pi ON p.product_id = pi.product_id";
    return executeResult($sql);
}


function getProductsByID($id) {
    $sql = "SELECT p.*, pi.image_source
            FROM product p
            INNER JOIN product_image pi ON p.product_id = pi.product_id
            WHERE p.product_id = $id";

    return executeSingleResult($sql);
}


function getImagesByID($id){
    $sql = "SELECT * FROM product_image WHERE product_id = $id";
    return executeResult($sql);
}

function addProduct($name,$quantity,$price,$desscripton,$cateID){
    $sql = "INSERT INTO product(product_name,product_quantity,product_price,product_descriptions,category_id) VALUES ('$name',$quantity,$price,'$desscripton',$cateID)";
    return execute($sql);
}

function updateProduct($id,$name,$quantity,$price,$desscripton,$cateID){
    $sql = "UPDATE product set product_name = '$name',product_quantity = $quantity , product_price = $price ,product_descriptions = '$desscripton',category_id = $cateID WHERE product_id = $id ";
    return execute($sql);
}

function uploadImages($uploadImages,$product_id){
    $files = array();
    $errors = array();

    foreach ($uploadImages as $key => $values){
        foreach($values as $index => $value){
            $files[$index][$key] = $value;
        }
    }
    $uploadPath = "../../Assets/Images/product/";
    if(!is_dir($uploadPath)){
        mkdir($uploadPath);
    }

    foreach($files as $file){
        $file = validateUploadFile($file,$uploadPath);
        if($file != false){
            move_uploaded_file($file['tmp_name'],$uploadPath.'/'.$file['name']);

            $image = 'Images/product/'.$file['name'].'';
            $sql = 'INSERT INTO product_image(image_source,product_id) VALUES ("'.$image.'",'.$product_id.')';
            execute($sql);
        }else{
            $errors[] = "The file".basename($file["name"])."isn't valid";
        }
    }
    return $errors;
}

function validateUploadFile($file,$uploadPath){
    if($file['size'] > 2*1024*1024){
        return false;
    }

    $validTypes = array("jpg","jpeg","png","bmp");
    $fileType = substr($file['name'],strrpos($file['name'],".")+1);
    if(!in_array($fileType,$validTypes)){
        return false;
    }

    $num = 1;
    $fileNameCheck = substr($file['name'],0,strrpos($file['name'],"."));
    $fileName = $fileNameCheck;
    while(file_exists($uploadPath.'/'.$fileName.".".$fileType)){
        $fileName = $fileNameCheck . "(".$num.")";
        $num++;
    }
    $file['name'] = $fileName.'.'.$fileType;
    return $file;
}

function updateImage($id,$name,$quantity,$price,$description,$cateID,$uploadImages){
    updateProduct($id,$name,$quantity,$price,$description,$cateID);
    if(!empty($uploadImages)){
        $uploadPath = "../../Assets/Images/product/";
        if(!is_dir($uploadPath)){
            mkdir($uploadPath);
        }

        if($uploadImages['name'][0] != ""){
            $sql = "DELETE FROM product_image WHERE product_id = $id";
            execute($sql);

            foreach($uploadImages['tmp_name'] as $index => $tmp_name){
                $fileName = $uploadImages['name'][$index];
                $targetFilePath = $uploadPath . $fileName;
                move_uploaded_file($tmp_name,$targetFilePath);
                $image_source = "Images/product/".$fileName;
                $sql = "INSERT INTO product_image(image_source,product_id) VALUES ('$image_source',$id)";
                execute($sql);
            }
        }
    }

}

function deleteImages($id) {
    $images = getImagesByID($id);

    $errors = array();

    foreach ($images as $image) {
        $path = '../../Assets/' . $image['image'];

        if (file_exists($path)) {
            unlink($path);
        } else {
            $errors[] = "Image not found: " . $image['image'];
        }

        $image_id = $image['image_id']; 
        $sql = "DELETE FROM product_image WHERE product_id = $id AND image_id = $image_id";
        $result = execute($sql);

        if (!$result) {
            $errors[] = "Something went wrong while deleting image with image_id: $image_id";
        }
    }
    return $errors;
}


function deleteProduct($id) {
    $errors = deleteImages($id);

    $sql = "DELETE FROM product WHERE product_id = $id";
    $result = execute($sql);

    if ($result && empty($errors)) {
        // Product and images deleted successfully
        echo json_encode(array('status' => 'success'));
    } else {
        // An error occurred while deleting the product or images
        echo json_encode(array('status' => 'error', 'errors' => $errors));
    }

}

?>