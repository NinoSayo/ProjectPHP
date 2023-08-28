<?php
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already logged in";
    header("Location: index.php");  
    exit();
}

include("Includes/header.php");
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
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="Functions/authcode.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="password" required>
                                <label for="floatingInput">Password</label>
                            </div>
                            <button type="submit" name="login-btn" class="btn btn-primary">Login</button>
                            <a href="register.php" class="btn btn-primary">Register</a>
                            <a href="forgot-password.php" class="btn btn-primary" style="float: right;">Forgot Password</a>
                        </form>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include("Includes/footer.php");

?>