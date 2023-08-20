<?php

include("../Functions/redirect.php");


if(isset($_SESSION['auth'])){
    if($_SESSION['Role'] != 1){
        redirect("../index.php","You are not authorized to access this page");
    }
}else{
    redirect("../login.php","Login to continue");

}

?>