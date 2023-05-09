<?php
session_start();

$page_title = "Password Reset Form";
include('includes/header.php');

?>

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
                        <h4>Reset Password</h4>
                    </div>
                    <div class="card-body">
                    <form action="password-reset-code.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" pattern="^[a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+@gmail\.com$" placeholder="@gmail.com">
                        </div>
                        <button type="submit" name="password_reset_link" class="btn btn-primary loginbtn mb-2 mt-2 btn-green">Send Password Reset Link</button>
                    </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>


    
<?php include('includes/footer.php');  ?>   