<?php
session_start();
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
                        <h4>Change Password</h4>
                    </div>
                    <div class="card-body">
                    <form action="password-reset-code.php" method="POST">
                        <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" required name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" pattern="^[a-zA-Z0-9$&+,:;=?@#|'<>.-^*()%!]+@gmail\.com$" placeholder="@gmail.com">
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-12 control-label" for="passwordinput">
                                New Password
                            </label>
                            <div class="col-md-12">
                                <input id="password" class="form-control mb-1 input-md password-input"  
                                name="new_password" type="password" 
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                <div id="popover-password">
                                    <input type="checkbox" onclick="passwordFunction()" class="mb-3 form-check-input"> Show Password

                                    <p><span id="result"></span></p>
                                    <div class="progress">
                                        <div id="password-strength" 
                                            class="progress-bar" 
                                            role="progressbar" 
                                            aria-valuenow="40" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100" 
                                            style="width:0%">
                                        </div>
                                    </div>
                                    <ul class="list-unstyled">
                                        <li class="">
                                            <span class="low-upper-case">
                                                <i class="fas fa-circle" aria-hidden="true"></i>
                                                &nbsp;Lowercase &amp; Uppercase
                                            </span>
                                        </li>
                                        <li class="">
                                            <span class="one-number">
                                                <i class="fas fa-circle" aria-hidden="true"></i>
                                                &nbsp;Number (0-9)
                                            </span> 
                                        </li>
                                        <li class="">
                                            <span class="eight-character">
                                                <i class="fas fa-circle" aria-hidden="true"></i>
                                                &nbsp;At least 8 Character
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <label class="form-label mb-0">Confirm Password</label>
                                <input type="password" required name="confirm_password" class="form-control mb-2" id="paste-no-event">
                        </div>
                        <button type="submit" name="password_update" class="btn btn-primary loginbtn mb-2 mt-2">Update Password</button>
                    </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>


    
<?php include('includes/footer.php');  ?> 

