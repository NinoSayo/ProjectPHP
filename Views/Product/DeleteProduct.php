<?php
require_once("../../Controllers/productController.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];
        $result = deleteProduct($productID);

        if ($result) {
            // Product deleted successfully
            echo json_encode(array('status' => 'success'));
            exit();
        } else {
            // An error occurred while deleting the product
            echo json_encode(array('status' => 'error'));
            exit();
        }
    }
}
?>