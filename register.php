<?php
session_start();
include("Includes/header.php");
?>
<style>
    input::placeholder{
    font-weight: normal;
    }

    input::placeholder strong {
    font-weight: bold;
    }
</style>
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
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form action="Functions/authcode.php" method="POST">
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="fname"  class="form-control" placeholder="First name" aria-label="First name" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="lname"  class="form-control" placeholder="Last name" aria-label="Last name" required>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username" required>
                                <label for="floatingInput">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="phone" name="phone" class="form-control" id="floatingInput" placeholder="phone" required>
                                <label for="floatingInput">Phone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="password" required>
                                <label for="floatingInput">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="cpassword" class="form-control" id="floatingInput" placeholder="confirm password" required>
                                <label for="floatingInput">Confirm password</label>
                            </div>
                            <button type="submit" name="register-btn" class="btn btn-primary">Submit</button>
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