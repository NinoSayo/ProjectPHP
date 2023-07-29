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
                        echo 200; // 200 for updating the quantity
                    } else {
                        echo 500;
                    }
                } else {
                    // If the product does not exist in the cart, add a new row
                    $sql3 = "INSERT INTO carts (user_id, product_id, product_qty) VALUES ('$user_id', '$prod_id', '$prod_qty')";
                    $addToCart = mysqli_query($con, $sql3);

                    if ($addToCart) {
                        echo 201; // 201 for adding a new product to the cart
                    } else {
                        echo 500;
                    }
                }
                break;

            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
