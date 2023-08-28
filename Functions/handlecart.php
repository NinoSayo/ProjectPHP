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

                $sql2 = "SELECT SUM(product_qty) as total_qty FROM carts WHERE product_id = '$prod_id' and user_id = '$user_id'";
                $cartQTY = mysqli_query($con,$sql2);
                $cartQTYData = mysqli_fetch_assoc($cartQTY);
                $totalQTY = $cartQTYData['total_qty'];

                $remainingQTY = $currentQTY - $totalQTY;
                        
                if ($prod_qty <= $remainingQTY) {
                    $sql2 = "SELECT * FROM carts WHERE product_id = '$prod_id' AND user_id = '$user_id' "; 
                    $checkCart = mysqli_query($con, $sql2);
                
                    if (mysqli_num_rows($checkCart) > 0) {
                        $cartData = mysqli_fetch_assoc($checkCart);
                        $cart_id = $cartData['cart_id'];
                        $new_qty = $cartData['product_qty'] + $prod_qty;
                
                        $sql3 = "UPDATE carts SET product_qty = '$new_qty' WHERE cart_id = '$cart_id'";
                        $updateCart = mysqli_query($con, $sql3);
                
                        if ($updateCart) {
                            $response = array(
                                'status' => 'existing',
                                'qty_total' => $new_qty
                            );
                            echo json_encode($response);
                        } else {
                            echo 500;
                        }
                    } else {
                        // If the product does not exist in the cart, add a new row with quantity 1
                        $sql4 = "INSERT INTO carts (user_id, product_id, product_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                        $addToCart = mysqli_query($con, $sql4);
                
                        if ($addToCart) {
                            $response = array(
                                'status' => 'added'
                            );
                            echo json_encode($response); 
                        } else {
                            echo 500;
                        }
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
                
                    $sql1 = "SELECT product_quantity FROM product WHERE product_id = '$prod_id'";
                    $ProductQTY = mysqli_query($con, $sql1);
                    $row_product_qty = mysqli_fetch_assoc($ProductQTY);
                    $currentQTY = $row_product_qty['product_quantity'];
                
                    if ($prod_qty <= $currentQTY) {
                        $sql2 = "SELECT * FROM carts WHERE product_id = '$prod_id' AND user_id = '$user_id'";
                        $checkCart = mysqli_query($con, $sql2);
                
                        if (mysqli_num_rows($checkCart) > 0) {
                            $sql3 = "UPDATE carts SET product_qty = '$prod_qty' WHERE product_id = '$prod_id' AND user_id = '$user_id' ";
                            $updateCart2 = mysqli_query($con, $sql3);
                
                            if ($updateCart2) {
                                $response = array(
                                    'status' => 'success'
                                );
                                echo json_encode($response);
                            } else {
                                $response = array(
                                    'status' => 'update_failed'
                                );
                                echo json_encode($response);
                            }
                        } else {
                            $response = array(
                                'status' => 'cart_item_not_found'
                            );
                            echo json_encode($response);
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
