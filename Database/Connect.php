<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "project";

//Kết nối với database
function getConnection() {
    global $hostname, $user, $password, $database;
    $con = mysqli_connect($hostname, $user, $password, $database);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $con;
}

//Câu lệnh select
function executeResult($sql) {
    $con = getConnection();
    $result = mysqli_query($con, $sql);
    $data = [];
    if ($result) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($con);
    return $data;
}

//Câu lệch Insert,Update,Delete
function execute($sql) {
    $con = getConnection();
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
    return $result;
}

//Câu lệch select 1 giá trị (Ví dụ Select by ID)
function executeSingleResult($sql) {
    $con = getConnection();
    $result = mysqli_query($con, $sql);
    $row = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
    }
    mysqli_close($con);
    return $row;
}
?>
