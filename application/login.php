<?php 
session_start();

if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already logged in";
    header('Location: index.php');
    exit();
}

include('includes/header.php');  ?>

<div class="loginContainer py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php if(isset($_SESSION['message'])) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']; ?>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['message']);
            } ?>
                <div class="loginForm card">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                    <form action="functions/authcode.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" required name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <a href="password-reset.php">Forgot Password?</a><br>
                        <button type="submit" name="login_btn" class="btn btn-primary loginbtn mb-2 mt-2 btn-green">Login</button>
                    </form>
                    <div class="register text-center">
                        <h7>Don't have an account? <span class="loginSpan"><a href="register.php">Sign up here</a></span></h3><br>
                        <h7>Did not receive your email verification? <span class="loginSpan"><a href="resend-email-verification.php">Resend</a></span></h3>
                    </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>


    
<?php include('includes/footer.php');  ?>   