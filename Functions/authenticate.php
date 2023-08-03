<?php 


if(!isset($_SESSION['auth'])){
    redirect("login.php","You must login to see this page");
}


?>