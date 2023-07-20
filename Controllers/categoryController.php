<?php 
require_once("../../Database/Connect.php");

function getCategories() {
    $sql = "SELECT * FROM category";
    return executeResult($sql);
}

function getCategoriesByID($id) {
    $sql = "SELECT * FROM category WHERE category_id = $id";
    return executeSingleResult($sql);
}

function addCategory($name, $image, $description) {
    $sql = "INSERT INTO category (category_name, category_image, category_descriptions) VALUES ('$name', '$image', '$description')";
    return execute($sql);
}

function updateCategory($id, $name, $image, $description) {
    $sql = "UPDATE category SET category_name = '$name', category_image = '$image', category_descriptions = '$description' WHERE category_id = $id";
    return execute($sql);
}

function deleteCategory($id) {
    $category = getCategoriesByID($id);

    if($category && !empty($category)){
        $imagePath = "../../Assets/".$category['category_image'];
        if(file_exists($imagePath) && is_file($imagePath)){
            unlink ($imagePath);
        }
        $sql = "DELETE FROM category WHERE category_id = $id";
        return execute($sql);
    }else{
        return false;
    }
    }
   
?>
