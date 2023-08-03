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

                $user_id = $_SESSION['auth_user']['id'];

                $sql1 = "SELECT * FROM carts WHERE product_id = '$prod_id' AND user_id = '$user_id'";
                $checkCart = mysqli_query($con, $sql1);

                if (mysqli_num_rows($checkCart) > 0) {
                    // If the product already exists in the cart, update its quantity
                    $cartData = mysqli_fetch_assoc($checkCart);
                    $cart_id = $cartData['cart_id'];
                    $new_qty = $cartData['product_qty'] + $prod_qty;

                    $sql2 = "UPDATE carts SET product_qty = '$new_qty' WHERE cart_id = '$cart_id'";
                    $updateCart = mysqli_query($con, $sql2);

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
                    // If the product does not exist in the cart, add a new row
                    $sql3 = "INSERT INTO carts (user_id, product_id, product_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                    $addToCart = mysqli_query($con, $sql3);

                    if ($addToCart) {
                        $response = array(
                            'status' => 'added'
                        );
                        echo json_encode($response); //
                    } else {
                        echo 500;
                    }
                }
                break;
            case "update":    
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION['auth_user']['id'];

                
                $sql1 = "SELECT * FROM carts WHERE product_id = '$prod_id' AND user_id = '$user_id'";
                $checkCart = mysqli_query($con, $sql1);

                if (mysqli_num_rows($checkCart) > 0) 
                {
                 $sql4 = "UPDATE carts SET product_qty = '$prod_qty' WHERE product_id = '$prod_id' AND user_id = '$user_id' ";
                 $updateCart2 = mysqli_query($con,$sql4);

                 if($updateCart2){
                    echo 'success';
                 }else{
                    echo 'failed';
                 }
                } 
                else 
                {
                echo "Something went wrong";
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
