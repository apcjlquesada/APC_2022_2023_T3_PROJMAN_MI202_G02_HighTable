<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Change Password
                        <a href="adminSettings.php" class="btn btn-outline-light float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body text-center" id="">
                              <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                $sql = "SELECT * FROM user WHERE email = '$currentUser'";

                                $gotResults = mysqli_query($con, $sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults) > 0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                                    <form action="code.php" method="POST">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <label class="col-md-12 control-label" for="passwordinput">
                                                New Password
                                            </label>
                                                <input id="password" class="form-control mb-1 input-md password-input"  
                                                name="password" type="password" 
                                                placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <input type="checkbox" onclick="passwordFunction()" class="mb-3"> Show Password
                                                <div id="popover-password">
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
                                                    <ul class="list-unstyled control-label mt-2">
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
                                                                &nbsp;Atleast 8 Character
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div>
                                                <label class="col-md-12 control-label" for="passwordinput">
                                                    Confirm Password
                                                </label>

                                                <div class="col-md-12">
                                                    <input id="password" class="form-control mb-1 input-md password-input"  
                                                    name="confirm_password" type="password" 
                                                    placeholder="Enter your password">
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <label class="form-label mt-2 mb-0">Confirm Password</label>
                                                <input type="password" required name="confirm_password" class="form-control mb-2" id="paste-no-event">
                                        </div> -->
                                        <button type="submit" name="update_admin_btn" class="btn btn-success mb-2 mt-4 col-md-3 ">Update</button>
                                        </div>
                                        
                                    </form>
                                    <?php
                                        }
                                      }
                                    }
                                    ?>
                            
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>