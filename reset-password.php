<?php
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already logged in";
    header("Location: index.php");  
    exit();
}

include("Includes/header.php");
?>
 <?php
$email = $_GET["email"];
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?=$_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['message']); } ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                        <form action="xuly.php" method="POST">
                        <div class="form-floating mb-3">
                                <input type="password" name="newpassword" class="form-control" id="floatingInput" placeholder="New Password" required>
                                <input type="hidden" name="email" class="form-control" id="floatingInput" value="<?= $email ?>">
                                <label for="floatingInput">New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="confirmpassword" class="form-control" id="floatingInput" placeholder="Confirm Password" required>
                                <label for="floatingInput">Confirm Password</label>
                            </div>
                            <button type="submit" name="reset" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include("Includes/footer.php");

?>