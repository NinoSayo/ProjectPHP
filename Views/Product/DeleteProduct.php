    <?php
    require_once("../../Controllers/productController.php");

    if (isset($_POST['id'])) {
        $productID = $_POST['id'];

        // Delete product images first
        $errors = deleteImages($productID);

        // Delete the product itself
        $result = deleteProduct($productID);

        if ($result && empty($errors)) {
            // Product and images deleted successfully
            echo json_encode(array('status' => 'success'));
        } else {
            // An error occurred while deleting the product or images
            echo json_encode(array('status' => 'error', 'errors' => $errors));
        }
    }
    ?>