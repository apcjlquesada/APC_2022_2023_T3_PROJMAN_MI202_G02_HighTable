<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

    
<div class="py-5">
    <div class="viewOrderContainer profileContainer container">
    <div class="registrationForm card">
                        
                              <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                ?>
                                    <div class="registrationHeader card-header">
                                        <h4 class="text-white">New Address<a href="my-profile.php" class="btn btn-outline-light float-end print-hide"><i class="fa fa-reply"></i> Back</a></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                    <form action="functions/authcode.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label mb-0">Name</label>
                                            <input type="text" required name="address_name" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6" style="display:none;">
                                            <label class="form-label mb-0">Email</label>
                                            <input type="email" required name="email" class="form-control mb-2" value="<?= $currentUser ?>">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                                    <?php
                                                    require_once 'config/dbcon.php';
                                                        $region = '';
                                                        $query = "SELECT region FROM address GROUP BY region ORDER BY region ASC";
                                                        $result = mysqli_query($con, $query);
                                                        while($rows = mysqli_fetch_array($result)){
                                                            $region .= '<option value="'.$rows["region"].'">'.$rows["region"].'</option>';
                                                        }
                                                    ?>
                                                <label class="form-label mb-0">Region</label>
                                                <select name="region" id="region" class="form-control mt-2 action"> 
                                                    <option value="" selected disabled>Select Region</option>
                                                    <?php echo $region; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Province</label>
                                                <select name="province" id="province" class="form-control mt-2 action">
                                                    <option value="">Select Province</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">City</label>
                                                <select name="city" id="city" class="form-control mb-2 action">
                                                    <option value="">Select City</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label mb-0">Barangay</label>
                                                <select name="barangay" id="barangay" class="form-control mb-2 action">
                                                    <option value="">Select Barangay</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-md-6" style="display:none;">
                                                <label class="form-label mb-0">Delivery Fee</label>
                                                <select name="delivery_fee" id="delivery_fee" class="form-control ">
                                                    <option value="">Select Fee</option>
                                                    
                                                </select>
                                            </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">House Number</label>
                                            <input type="text" required name="house_number" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Street Name</label>
                                            <input type="text" required name="street" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Nearest Landmark</label>
                                            <input type="text" required name="landmark" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Postal Code</label>
                                            <input type="text" required name="postal_code" class="form-control mb-2" maxlength="4" pattern="[0-9]{4}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Status</label> <br>
                                            <input type="checkbox"  name="status"> Hide this address
                                        </div>
                                    </div>
                            </div>
                                        <div>
                                        <button type="submit" name="add_useraddress_btn" class="btn btn-primary mb-2 mt-4 col-md-3 btn-green float-end">Create Address</button>
                                        </div>
                                        
                                    </form>
                            </div>
                            </div>
                            
                        
                        </div>
                    </div>
    </div>
</div>
    
<?php include('includes/footer.php');  ?>   