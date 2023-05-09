<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Add Address
                    <a href="address.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0">Region</label>
                                <input type="text" required name="region" placeholder="Enter region" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Province</label>
                                <input type="text" required name="province" placeholder="Enter province" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">City</label>
                                <input type="text"  name="city" placeholder="Enter city" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Barangay</label>
                                <input type="text"  name="barangay" placeholder="Enter barangay" class="form-control mb-2">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Delivery Fee</label>
                                <input type="number"  name="delivery_fee" class="form-control mb-2">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Status</label> <br>
                                <input type="checkbox"  name="status">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_address_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>