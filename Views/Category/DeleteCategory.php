<?php
require_once("../../Controllers/categoryController.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $categoryID = $_POST['id'];
        $result = deleteCategory($categoryID);

        if ($result) {
            $response = array('status' => 'success');
            echo json_encode($response);
        } else {
            $response = array('status' => 'error_product');
            echo json_encode($response);
        }
    }
}
?>
