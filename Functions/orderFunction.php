<?php
session_start();
include("../Database/Connect.php");

if (isset($_SESSION['auth'])) {

    if (isset($_POST['placeOrder'])) {

        $firstname = mysqli_real_escape_string($con, $_POST['fname']);
        $lastname = mysqli_real_escape_string($con, $_POST['lname']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $pin = mysqli_real_escape_string($con, $_POST['pin']);
        $payment_method = mysqli_real_escape_string($con,$_POST['payment_method']);
        $shipping_method = $_POST['shipping_method'];
        
        if (empty($firstname) || empty($lastname) || empty($phone) || empty($email) || empty($country) || empty($address) || empty($city) || empty($pin)) {
            $_SESSION['message'] = "All fields must be filled";
        
            // Store user input in session
            $_SESSION['input']['fname'] = $firstname;
            $_SESSION['input']['lname'] = $lastname;
            $_SESSION['input']['phone'] = $phone;
            $_SESSION['input']['email'] = $email;
            $_SESSION['input']['country'] = $country;
            $_SESSION['input']['address'] = $address;
            $_SESSION['input']['city'] = $city;
            $_SESSION['input']['pin'] = $pin;
        
            header("Location: ../checkout.php");
            exit();
        }

        // Retrieve cart items
        $userID = $_SESSION['auth_user']['id'];
        $sql1 = "SELECT c.cart_id as cid, c.product_id as pid, c.product_qty, p.product_name, p.product_price
        FROM carts c
        LEFT JOIN product p ON c.product_id = p.product_id
        WHERE user_id = '$userID'
        ORDER BY c.cart_id DESC";

        $cartItems = mysqli_query($con, $sql1);

        if($shipping_method == 0){
            $shipping_fee = 5;
        }else if($shipping_method == 1){
            $shipping_fee = 20;
        }

        $totalPrice = 0;
        $totalQTY = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['product_price'] * $item['product_qty'];
            $totalQTY += $item['product_qty'];
        }

        $totalPrice += $shipping_fee;

        // Set other variables (shipping, payment, etc.)
        $user_id = $_SESSION['auth_user']['id'];
        $shipping_firstname = $firstname;
        $shipping_lastname = $lastname;

        function GenerateOrderNO($con){
            $OrderNO = mt_rand(100000,999999);

            $sql = "SELECT Order_NO FROM orders WHERE Order_NO = '$OrderNO'";
            $result = mysqli_query($con,$sql);

            while(mysqli_num_rows($result) > 0){
                $orderNO = mt_rand(100000,999999);
                $result = mysqli_query($con,$sql);
            }

            return $OrderNO;
        }

        $UniqueOrderNO = GenerateOrderNO($con);

        // Insert order into the database
        $sql2 = "INSERT INTO orders(user_id, Order_NO ,shipping_firstname, shipping_lastname, shipping_phone, shipping_email, shipping_country, shipping_address, shipping_city, shipping_pin, shipping_method ,total_qty ,total_price, payment_method) 
        VALUES ('$user_id', '$UniqueOrderNO' ,'$shipping_firstname', '$shipping_lastname', '$phone', '$email', '$country', '$address', '$city', '$pin', '$shipping_method' ,'$totalQTY' ,'$totalPrice', '$payment_method')";
        $orderInsert = mysqli_query($con,$sql2);

        if ($orderInsert) {
            $order_id = mysqli_insert_id($con);

            foreach ($cartItems as $item) {
                $product_id = $item['pid'];
                $item_price = $item['product_price'];
                $item_qty = $item['product_qty'];

                $sql3 = "INSERT INTO order_items(order_id, product_id, item_qty, item_price) 
                VALUES ('$order_id', '$product_id', '$item_qty', '$item_price')";   
                $itemInsert = mysqli_query($con,$sql3);

                $sql4 = "SELECT * FROM product WHERE product_id ='$product_id' LIMIT 1";
                $product = mysqli_query($con,$sql4);

                $productData = mysqli_fetch_array($product);
                $currentQty = $productData['product_quantity'];

                $new_qty = $currentQty - $item_qty;

                $sql5 = "UPDATE product SET product_quantity = '$new_qty' WHERE product_id = '$product_id' ";
                $updateProductQty = mysqli_query($con,$sql5);

            }

            $orderSQL = "SELECT Order_NO FROM orders WHERE order_id = '$order_id'";
            $result = mysqli_fetch_assoc(mysqli_query($con,$orderSQL));
            $OrderNO = $result['Order_NO'];

            $sql3 = "DELETE FROM carts WHERE user_id = '$user_id' ";
            $deleteCart = mysqli_query($con,$sql3);

            $_SESSION['message'] = "Order placed successfully";
            header("Location: ../orderdetail.php?id=$OrderNO");
            die();
             } else {
            
        }

    }

} else {
    header("Location: ../index.php");
    exit(); 
}
