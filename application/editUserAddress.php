<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

    
<div class="py-5">
    <div class="viewOrderContainer profileContainer container">
    <div class="registrationForm card">
                        
                              <?php
                               if(isset($_GET['id'])){
                                $id = $_GET['id'];
                                $address = getByID('user_address',$id);
            
                                if(mysqli_num_rows($address) > 0){
                                    $row = mysqli_fetch_array($address);
                                
                                            ?>
                                    <div class="registrationHeader card-header">
                                        <h4 class="text-white">Update <?= $row["address_name"] ?><a href="my-profile.php" class="btn btn-outline-light float-end print-hide"><i class="fa fa-reply"></i> Back</a>
</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                        <div class="col-md-12">
                                    <form action="functions/authcode.php" method="POST">
                                    <div class="row">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="col-md-12">
                                            <label class="form-label mb-0">Name</label>
                                            <input type="text" required name="address_name" class="form-control mb-2" value="<?= $row['address_name'] ?>">
                                        </div>
                                        <div class="col-md-6" style="display:none;">
                                            <label class="form-label mb-0">Email</label>
                                            <input type="email" required name="email" class="form-control mb-2" value="<?= $row['email'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                                <?php
                                                    $region = '';
                                                    $query = "SELECT region FROM address GROUP BY region ORDER BY region ASC";
                                                    $result = mysqli_query($con, $query);
                                                    while($rows = mysqli_fetch_array($result)){
                                                        $region .= '<option value="'.$rows["region"].'">'.$rows["region"].'</option>';
                                                    }
                                                ?>
                                            <label class="form-label mb-0">Region</label>
                                            <select name="region" id="region" class="form-control action"> 
                                                <option value="<?= $row["region"] ?>"><?= $row["region"] ?></option>
                                                <?php echo $region; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Province</label>
                                            <select name="province" id="province" class="form-control mb-2 action">
                                                <option value="<?= $row["province"] ?>"><?= $row["province"] ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">City</label>
                                            <select name="city" id="city" class="form-control mb-2 action">
                                                <option value="<?= $row["city"] ?>"><?= $row["city"] ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Barangay</label>
                                            <select name="barangay" id="barangay" class="form-control mb-2 action">
                                                <option value="<?= $row["barangay"] ?>"><?= $row["barangay"] ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6" style="display:none;">
                                            <label class="form-label mb-0">Delivery Fee</label>
                                            <select name="delivery_fee" id="delivery_fee" class="form-control">
                                                <option value="<?= $row["delivery_fee"] ?>"><?= $row["delivery_fee"] ?></option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">House Number</label>
                                            <input type="text" required name="house_number" class="form-control mb-2" value="<?= $row['house_number'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Street Name</label>
                                            <input type="text" required name="street" class="form-control mb-2" value="<?= $row['street'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Nearest Landmark</label>
                                            <input type="text" required name="landmark" class="form-control mb-2" value="<?= $row['landmark'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mb-0">Postal Code</label>
                                            <input type="text" required name="postal_code" class="form-control mb-2" maxlength="4" pattern="[0-9]{4}" value="<?= $row['postal_code'] ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Status</label> <br>
                                            <input class="form-check-input" type="checkbox"  name="status" <?= $row['status'] == '0'?'':'checked' ?>> Hide this address
                                        </div>
                                    </div>
                            </div>
                                        <div>
                                        <button type="submit" name="update_useraddress_btn" class="btn btn-primary mb-2 mt-4 col-md-3 btn-green float-end">Update</button>
                                        </div>
                                        
                                    </form>
                                    <?php
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