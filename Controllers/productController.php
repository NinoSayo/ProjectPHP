<?php
require_once("../../Database/Connect.php");

function getProducts(){
    $sql = "SELECT p.* , pi.image_id , pi.image_source FROM product p LEFT JOIN product_image pi on p.product_id = pi.product_id";
    return executeResult($sql);
}

function getProductsByID($id) {
    $sql = "SELECT p.*,pi.image_id , pi.image_source FROM product p LEFT JOIN product_image pi on p.product_id = pi.product_id WHERE p.product_id = $id";
    return executeSingleResult($sql);
}

function addProduct($name,$quantity,$price,$description,$category_id){
    $sql = "INSERT INTO product (product_name,product_quantity,product_price,product_descriptions,category_id) VALUES ('$name',$quantity,$price,'$description',$category_id)";
    $productID = execute($sql);

    if($productID){
        if(isset($_FILES['image'])){
            UploadImages($_FILES,$productID);
        }
    }
    return $productID;
}

function updateProduct($id,$name,$quantity,$price,$description,$category_id){
    $sql = "UPDATE product SET product_name = '$name',product_quantity = $quantity,product_price = $price,product_descriptions = '$description',category_id = $category_id WHERE product_id = $id";
    execute($sql);

    if(isset($_FILES['image'])){
        $sql = "DELETE FROM product_image WHERE product_id = $id";
        execute($sql);
        UploadImages($_FILES['image'],$id);
    }
}

function UploadImages($uploadImages,$productID){
    $files = array();
    $errors = array();

    foreach($uploadImages as $key => $values){
        foreach($values as $index => $value){
            $files[$index][$key] = $value;
        }
    }
    $uploadPath = "../../Assets/Images/product";
    if(!is_dir($uploadPath)){
        mkdir($uploadPath);
    }

    foreach($files as $file){
        $file = validateUploadFile($file,$uploadPath);
        if($file != false){
            move_uploaded_file($file['tmp_name'],$uploadPath . '/' . $file['name']);
            $image = 'Images/product/' .$file['name'].'';
            $sql = "INSERT INTO product_image (image_source, product_id) VALUES ('$image', $productID)";
            execute($sql);
        }else{
            $errors[] = "The file".basename($file['name'])."Isn't valid";
        }
    }
return $errors;
}

function validateUploadFile($file,$uploadPath){
    if($file['size'] > 2*1024*1024){ //max upload là 2mb
        return false;
    }

    $validTypes = array("jpg","jpeg","png","bmp");
    $fileTypes = substr($file['name'],strrpos($file['name'],".") + 1);
    if(!in_array($fileTypes,$validTypes)){
        return false;
    }

    $num = 1;
    $fileNamecheck = substr($file['name'],0,strrpos($file['name'],"."));
    $filename = $fileNamecheck;
    while(file_exists($uploadPath.'/'.$filename.".".$fileTypes)){
        $filename = $fileNamecheck . "(".$num.")";
        $num++;
    }
    $file['name'] = $filename.'.'.$fileTypes;
    return $file;
}

function deleteProduct($id) {
    $product = getProductsByID($id);

    if($product && !empty($product)){
        // Assuming there's a product_image field in the product table
        $imagePath = "../../Assets/".$product['image_source'];
        if(file_exists($imagePath) && is_file($imagePath)){
            unlink ($imagePath);
        }   

        $sql = "DELETE FROM product_image WHERE product_id = $id";
        execute($sql);

        $sql = "DELETE FROM product WHERE product_id = $id";
        return execute($sql);
    } else {
        return false;
    }
}

?>