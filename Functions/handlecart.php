<?php

session_start();
include("../Database/Connect.php");

if (isset($_SESSION['auth'])) {

    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
            
                if ($prod_qty <= 0) {
                    $response = array(
                        'status' => 'invalid_quantity'
                    );
                    echo json_encode($response);
                    break;
                }
            
                $user_id = $_SESSION['auth_user']['id'];
            
                $sql1 = "SELECT product_quantity FROM product WHERE product_id = '$prod_id'";
                $ProductQTY = mysqli_query($con, $sql1);
                $row_product_qty = mysqli_fetch_assoc($ProductQTY);
                $currentQTY = $row_product_qty['product_quantity'];
            
                if ($prod_qty <= $currentQTY) {
                    // Add the item to the cart
                    $sql2 = "INSERT INTO carts (user_id, product_id, product_qty) VALUES ('$user_id', '$prod_id', '1')";
                    $addToCart = mysqli_query($con, $sql2);
            
                    if ($addToCart) {
                        // Decrement product_quantity by 1
                        $new_product_qty = $currentQTY - 1;
                        $sql3 = "UPDATE product SET product_quantity = '$new_product_qty' WHERE product_id = '$prod_id'";
                        $updateProductQty = mysqli_query($con, $sql3);
            
                        if ($updateProductQty) {
                            $response = array(
                                'status' => 'added'
                            );
                            echo json_encode($response);
                        } else {
                            echo 500;
                        }
                    } else {
                        echo 500;
                    }
                } else {
                    $response = array(
                        'status' => 'out_of_stock'
                    );
                    echo json_encode($response);
                }
                break;
            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                if ($prod_qty <= 0) {
                    $response = array(
                        'status' => 'invalid_quantity'
                    );
                    echo json_encode($response);
                    break;
                }
            
                $user_id = $_SESSION['auth_user']['id'];
            
                $sql5 = "SELECT product_quantity FROM product WHERE product_id = '$prod_id'";
                $ProductQTY = mysqli_query($con, $sql5);
                $row_product_qty = mysqli_fetch_assoc($ProductQTY);
                $currentQTY = $row_product_qty['product_quantity'];
            
                if ($prod_qty <= $currentQTY) {
                    $sql6 = "SELECT * FROM carts WHERE product_id = '$prod_id' AND user_id = '$user_id'";
                    $checkCart = mysqli_query($con, $sql6);
            
                    if (mysqli_num_rows($checkCart) > 0) {
                        $sql7 = "UPDATE carts SET product_qty = '$prod_qty' WHERE product_id = '$prod_id' AND user_id = '$user_id' ";
                        $updateCart2 = mysqli_query($con, $sql7);
            
                        if ($updateCart2) {
                            echo 'success';
                        } else {
                            echo 'failed';
                        }
                    } else {
                        echo "Something went wrong";
                    }
                } else {
                    $response = array(
                        'status' => 'out_of_stock'
                    );
                    echo json_encode($response);
                }
                break;
        
            case "delete":
                $cart_id = $_POST['cart_id'];      
                
                $user_id = $_SESSION['auth_user']['id'];

                
                $sql1 = "SELECT * FROM carts WHERE cart_id = '$cart_id' AND user_id = '$user_id'";
                $checkCart = mysqli_query($con, $sql1);

                if (mysqli_num_rows($checkCart) > 0) 
                {
                 $sql5 = "DELETE FROM carts WHERE cart_id = '$cart_id' ";
                 $deleteCart = mysqli_query($con,$sql5);

                 if($deleteCart){
                    echo 'success';
                 }else{
                    echo 'Failed to delete the item';
                 }
                } 
                else 
                {
                echo "Something went wrong";
                }
                break; 

                default:
                echo 500;
        }
    }
} else {
    $response = array(
        'status' => 'login'
    );
    echo json_encode($response);
}
