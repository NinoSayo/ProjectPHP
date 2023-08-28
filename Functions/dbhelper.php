<?php
$hostname='localhost';
$usernamedb='root';
$passworddb='';
$database='project';

//su dung cho cau lenh select
function executeResult($sql){
    global $hostname, $usernamedb, $passworddb,$database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    $data = [];
    if($result != null){
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
    }
    mysqli_close($con);
    return $data;
} 

//su dung cho cau lenh insert, update, delete
function execute($sql){
    global $hostname, $usernamedb, $passworddb,$database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    return $result;
}

//su dung cho cau lenh select (1 record)
function executeSingleResult($sql){
    global $hostname, $usernamedb, $passworddb,$database;
    $con = mysqli_connect($hostname, $usernamedb, $passworddb, $database);
    $result = mysqli_query($con, $sql);
    if($result != null){
        $row = mysqli_fetch_array($result,1);
    }
    mysqli_close($con);
    return $row;
}
function getDBConnection() {
    $servername = "localhost"; // Thay đổi theo thông tin cơ sở dữ liệu của bạn
    $username = "root"; // Thay đổi theo tên đăng nhập cơ sở dữ liệu của bạn
    $password = ""; // Thay đổi theo mật khẩu cơ sở dữ liệu của bạn
    $dbname = "project"; // Thay đổi theo tên cơ sở dữ liệu của bạn

    // Tạo kết nối
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connection;
}
