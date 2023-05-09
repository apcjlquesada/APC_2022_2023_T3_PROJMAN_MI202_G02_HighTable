<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

    
<div class="py-5">
    <div class="viewOrderContainer profileContainer container">
    <div class="registrationForm card">
                        <div class="registrationHeader card-header">
                            <h4 class="text-white">Update My Profile<a href="my-profile.php" class="btn btn-outline-light float-end print-hide"><i class="fa fa-reply"></i> Back</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                              <div class="col-md-6">
                              <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                $sql = "SELECT * FROM user WHERE email = '$currentUser'";

                                $gotResults = mysqli_query($con, $sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults) > 0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                                    <form action="functions/authcode.php" method="POST">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">First Name</label>
                                            <input type="text" required name="first_name" class="form-control mb-2" value="<?= $row['first_name'] ?>">
                                        </div>    
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Last Name</label>
                                            <input type="text" required name="last_name" class="form-control mb-2" value="<?= $row['last_name'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Contact Number</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <div class="input-group-text">+63</div>
                                                </div>
                                                <input type="tel" required name="phone" class="form-control mb-2" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="<?= $row['phone'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <label for="exampleInputEmail1" class="form-label mb-0">Email address</label>
                                                <input type="email" required name="email" class="form-control mb-2" aria-describedby="emailHelp" value="<?= $row['email'] ?>">
                                        </div>
                                        
                                    </div>
                            </div>
                            <div class="col-md-6">
                                        <div class="col-md-12">
                                                <!--<label for="exampleInputPassword1" class="form-label mb-0">Password</label>
                                                <input type="password" required name="password" class="form-control mb-1" id="password-input" value="<?= $row['password'] ?>">
                                                <input type="checkbox" onclick="passwordFunction()" class="mb-3"> Show Password -->
                                                <label class="col-md-12 control-label" for="passwordinput">
                                                    Password
                                                </label>
                                                <div class="col-md-12">
                                                    <input id="password" class="form-control mb-1 input-md password-input"  
                                                    name="password" type="password" 
                                                    placeholder="Enter your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" value="<?= $row['password'] ?>" required>
                                                    <div id="popover-password">
                                                        <input type="checkbox" onclick="passwordFunction()" class="form-check-input mb-3"> Show Password
        
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
                                                                    &nbsp;Atleast 8 Character
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label mt-2 mb-0">Confirm Password</label>
                                                <input type="password" required name="confirm_password" class="form-control mb-2" id="paste-no-event">
                                        </div>
                                        <button type="submit" name="update_profile_btn" class="btn btn-primary mb-2 mt-4 col-md-3 btn-green">Update</button>
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
</div>
    
<?php include('includes/footer.php');  ?>   