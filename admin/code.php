<?php
include("../Database/Connect.php");
include("../Functions/redirect.php");
include("../Functions/myFunction.php");

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $image = "Images/category/" . basename($_FILES['image']['name']);
    $imagePath = "../Assets/Images/category/" . basename($_FILES['image']['name']);

    $sql1 = "INSERT INTO category(category_name,category_image,category_descriptions) VALUES ('$name','$image','$description')";

    $addCategory = mysqli_query($con, $sql1);

    if ($addCategory) {
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        redirect("addCategory.php", "Category added successfully");
    } else {
        redirect("addCategory.php", "Failed to add category");
    }
} else if (isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $new_image = "Images/category/" . basename($_FILES['image']['name']);
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $update_filename = $new_image;
    } else {
        $update_filename = $old_image;
    }
    $imagePath = "../Assets/Images/category/" . basename($_FILES['image']['name']);
    $sql2 = "UPDATE category set category_name = '$name' , category_image = '$update_filename',category_descriptions = '$description' WHERE category_id = '$category_id'";

    $update = mysqli_query($con,$sql2);

    if($update){
        if($_FILES['image']['name'] !="")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            if(file_exists("../Assets/".$old_image)){
                unlink("../Assets/".$old_image);
            }
        }
        redirect("editCategory.php?id=$category_id","Category updated successfully");
    }else{
        redirect("editCategory.php?id=$category_id","Update failed");
    }
}
else if(isset($_POST['delete_category'])){
    $category_id = mysqli_real_escape_string($con,$_POST['category_id']);

    $sql3 = "SELECT * FROM category WHERE category_id = '$category_id'";
    $category = mysqli_query($con,$sql3);
    $categoryData = mysqli_fetch_array($category);
    $image = $categoryData['category_image'];

    $sql4 = "DELETE FROM category WHERE category_id = '$category_id'";
    $delete = mysqli_query($con,$sql4);

    if($delete){
        if(file_exists("../Assets/".$image)){
            unlink("../Assets/".$image);
        }
        redirect("category.php","Category deleted successfully");
    }else{
        redirect("category.php","Delete failed");

    }
}

if(isset($_POST['add_product'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql1 = "INSERT INTO product(product_name,product_quantity,product_price,product_descriptions,category_id) VALUES ('$name',$quantity,$price,'$description','$category_id')";
    $addProduct = mysqli_query($con,$sql1);

    if($addProduct){
        if(isset($_FILES['image'])){
            $sql2 = "SELECT max(product_id) AS new_product_id FROM product";
            $result = mysqli_query($con,$sql2);
            $row = mysqli_fetch_assoc($result);
            $new_product_id = $row['new_product_id'];
            uploadImages($_FILES['image'],$new_product_id,$con);
        }
        redirect("addProduct.php","Product added successfully");
    }else{
        redirect("addProduct.php","Failed to add product");
    }
}else if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];

    $new_images = $_FILES['image']['name']; // Get the names of the new image files
    $old_image = $_POST['old_image']; // Get the name of the old image file

    // Check if new images were selected
    if (!empty($new_images[0])) {
        // Upload the new images and set $update_filenames array to the new image names
        $update_filenames = array();
        foreach ($new_images as $index => $new_image) {
            $update_filename = "../Assets/Images/product/" . basename($new_image);
            move_uploaded_file($_FILES['image']['tmp_name'][$index], $update_filename);
            $update_filenames[] = $update_filename;
        }
    
        // Delete existing images associated with the product
        $sql4 = "DELETE FROM product_image WHERE product_id = '$product_id'";
        mysqli_query($con, $sql4);
    
        // Associate the new images with the product
        foreach ($update_filenames as $update_filename) {
            associateProductImage($product_id, $update_filename, $con);
        }
    } else {
        // Keep the old image, set $update_filename to the old image name
        $update_filename = $old_image;
    }

    $sql3 = "UPDATE product SET product_name = '$name', product_quantity = $quantity, product_price = $price, product_descriptions = '$description', category_id = $category_id WHERE product_id = '$product_id'";
    $update = mysqli_query($con, $sql3);

    if ($update) {
        redirect("editProduct.php?id=$product_id", "Product updated successfully");
    } else {
        redirect("editProduct.php?id=$product_id", "Update failed");
    }
}else if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $sql_images = "SELECT image_source FROM product_image WHERE product_id = '$product_id'";
    $image_results = mysqli_query($con, $sql_images);
    $image_sources = array();
    while ($row = mysqli_fetch_assoc($image_results)) {
        $image_sources[] = $row['image_source'];
    }

    $sql_delete_images = "DELETE FROM product_image WHERE product_id = '$product_id'";
    $result_delete_images = mysqli_query($con, $sql_delete_images);

    if ($result_delete_images) {
        // Delete images from the physical folder
        foreach ($image_sources as $image_source) {
            $image_path = "../Assets/" . $image_source;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $sql_delete_product = "DELETE FROM product WHERE product_id = '$product_id'";
        $result_delete_product = mysqli_query($con, $sql_delete_product);

        if ($result_delete_product) {
            echo "success";
        } else {
            echo "error";
        }
    }
}else {
    header("Location: ../index.php");
}

?>
