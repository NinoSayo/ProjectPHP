<?php
require_once("../../Controllers/productImageController.php");
function UploadImage($uploadedImage,$product_id){
    $files = array();
    $errors = array();

    foreach($uploadedImage as $key => $values){
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
            move_uploaded_file($file['tmp_nam'],$uploadPath.'/'.$file['name']);
            $image = 'image/product/'.$file['name'].'';
            addImageProduct('.$product_name.',"'.$image_name.'", $product_id);
        }
    }

}

?>