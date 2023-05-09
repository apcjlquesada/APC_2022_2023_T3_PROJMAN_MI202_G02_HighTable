<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $address = getByID('address',$id);

                    if(mysqli_num_rows($address) > 0){
                        $data = mysqli_fetch_array($address);
                        ?>
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="text-white">Edit Address
                                    <a href="address.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <div class="col-md-6">
                                            <label class="mb-0">Region</label>
                                            <input type="text" required name="region" value="<?= $data['region']; ?>" placeholder="Enter region" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0">Province</label>
                                            <input type="text" required name="province" value="<?= $data['province']; ?>" placeholder="Enter province" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">City</label>
                                            <input type="text"  name="city" value="<?= $data['city']; ?>" placeholder="Enter city" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Barangay</label>
                                            <input type="text"  name="barangay" value="<?= $data['barangay']; ?>" placeholder="Enter barangay" class="form-control mb-2">
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Delivery Fee</label>
                                            <input type="number"  name="delivery_fee" value="<?= $data['delivery_fee']; ?>" class="form-control mb-2">
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Status</label> <br>
                                            <input type="checkbox"  name="status" <?= $data['status'] == '0'?'':'checked' ?>>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="update_address_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        echo "Address not found";
                    }
                }
                else{
                    echo "ID missing from url";
                }
                    ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>