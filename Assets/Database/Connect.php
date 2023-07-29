<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "project";

$con = mysqli_connect($hostname,$user,$password,$database);

if(!$con){
    die("Connect Failed".mysqli_connect_error());
}
?>
