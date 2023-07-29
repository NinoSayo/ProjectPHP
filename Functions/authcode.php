<?php
session_start();
include("../Database/Connect.php");
if (isset($_POST['register-btn'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Check if email, username, or phone number is already registered
    $sql = "SELECT * FROM users WHERE email = '$email' OR username = '$username' OR phone = '$phone'";
    $checkValidation = mysqli_query($con, $sql);

    if (mysqli_num_rows($checkValidation) > 0) {
        $row = mysqli_fetch_assoc($checkValidation);
        if ($row['email'] === $email) {
            $_SESSION['message'] = "Email already registered";
        } elseif ($row['username'] === $username) {
            $_SESSION['message'] = "Username already registered";
        } 
        header("Location: ../register.php");
        exit();
    }else{
    // If all checks pass, proceed with the registration process
    if ($password === $cpassword) {
        $sql = "INSERT INTO users(first_name, last_name, username, email, phone, password) VALUES ('$fname', '$lname', '$username', '$email', '$phone', '$password')";
        $addUser = mysqli_query($con, $sql);

        if ($addUser) {
            $_SESSION['message'] = "Register successfully";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Register failed";
            header("Location: ../register.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Password do not match";
        header("Location: ../register.php");
        exit();
    }
}
}else if(isset($_POST['login-btn'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $sql3 = "SELECT * FROM users WHERE email = '$email' and password= '$password'";
    $login = mysqli_query($con,$sql3);

    if(mysqli_num_rows($login) > 0){
        $_SESSION['auth'] = true;
        $userData = mysqli_fetch_array($login);
        $userid = $userData['id'];
        $username = $userData['username'];
        $useremail = $userData['email'];
        $Role = $userData['Role'];
        $_SESSION['auth_user'] = [

            'id' => $userid,
            'username' => $username,
            'email' => $useremail,
        ];

        $_SESSION['Role'] = $Role;

        if($Role == 1){
            $_SESSION['message'] = "Welcome to Dashboard";
        header("Location: ../admin/index.php");
        }else{
            $_SESSION['message'] = "Login successfully";
            header("Location: ../index.php");   
        }


    }else{
        $_SESSION['message'] = "Invalid login";
        header("Location: ../login.php");
    }
}
?>
