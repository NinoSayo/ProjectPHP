<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include('vendor/autoload.php');
include("Database/Connect.php");
error_reporting(0);
define("SMTP_HOST", "smtp.gmail.com"); //Hostname of the mail server
define("SMTP_PORT", "465"); //Port of the SMTP like to be 25, 80, 465 or 587
define("SMTP_UNAME", "purplerose2305@gmail.com"); //Username for SMTP authentication any valid email created in your domain
define("SMTP_PWORD", "vtsvzroezxsrvvze"); //Password for SMTP authentication
// you can get your SMTP host here http://www.asif18.com/6/php/list-of-smtp-and-pop3-severs,-hosts,-ports-email-servers/
//Contact
if (isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tieude = $_POST['tieude'];
    $noidungpost = $_POST['noidung'];
    $noidung = '<strong>Name : </strong> ' . $name . '<br><strong>Email : </strong> ' . $email . '<br><strong>Subject : </strong> ' . $tieude . '<br> <strong>Message : </strong><br><p>' . $noidungpost . '</p>';
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_UNAME;
        $mail->Password = SMTP_PWORD;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = SMTP_PORT;
        $mail->setFrom(SMTP_UNAME, "MINISHOP");
        $mail->addAddress("thanhnghia122004@gmail.com", "Chủ Shop");
        $mail->addReplyTo(SMTP_UNAME, 'MINISHOP');
        $mail->isHTML(true);
        $mail->Subject = 'Feedback';
        $mail->Body = $noidung;
        $mail->AltBody = $noidung;
        $result = $mail->send();
        if (!$result) {
            $error = "Có lỗi xảy ra trong quá trình gửi mail";
        }
        header('Location: contact.php');
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
//Forgot Password
if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    $sqlcheck = "SELECT * FROM users WHERE email = '$email'";
    $check = mysqli_query($con, $sqlcheck);
    if (mysqli_num_rows($check) > 0) {
        $noidung = "
    <html>
    <head>
        <style>
            .button {
                background-color: #4CAF50;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <p>Please click the button below to reset the password :</p>
        <a href='http://localhost/ProjectPHP-main/reset-password.php?email=$email' class='button'>Reset Password</a>
    </body>
    </html>
";
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_UNAME;
            $mail->Password = SMTP_PWORD;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = SMTP_PORT;
            $mail->setFrom(SMTP_UNAME, "MINISHOP");
            $mail->addAddress($email, $email);
            $mail->addReplyTo(SMTP_UNAME, 'MINISHOP');
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $mail->Body = $noidung;
            $mail->AltBody = $noidung;
            $result = $mail->send();
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
            $_SESSION['message'] = "Please check your email to reset your password";
            header("Location: forgot-password.php");
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    } else {
        $_SESSION['message'] = "Email does not exist in the system";
        header("Location: forgot-password.php");
        exit();
    }
}
//Reset Password
if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    if($newpassword !=  $confirmpassword){
        $_SESSION['message'] = "Two passwords do not match";
        header("Location: reset-password.php?email=$email");
    }
    else {
        $sqlcheck = "UPDATE users SET password = '$newpassword' WHERE email = '$email'";
        $check = mysqli_query($con, $sqlcheck);
        $noidung = "Your account's new password has changed to : $newpassword";
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = "UTF-8";
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_UNAME;
            $mail->Password = SMTP_PWORD;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = SMTP_PORT;
            $mail->setFrom(SMTP_UNAME, "MINISHOP");
            $mail->addAddress($email, $email);
            $mail->addReplyTo(SMTP_UNAME, 'MINISHOP');
            $mail->isHTML(true);
            $mail->Subject = 'Reset password successfully';
            $mail->Body = $noidung;
            $mail->AltBody = $noidung;
            $result = $mail->send();
            if (!$result) {
                $error = "Có lỗi xảy ra trong quá trình gửi mail";
            }
            $_SESSION['message'] = "Password reset successful. Please log in";
        header("Location: login.php");
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
       
    }
}
?>