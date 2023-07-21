<?php
require_once("../../Controllers/productController.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id'])){
        $productID = $_POST['id'];
        $result = deleteProduct($productID);

        if($result){
            $response = array('status' => 'success');
            echo json_encode($response);
        }
    }
}
?>