<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Add Ingredient
                    <a href="inventory.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0">Name</label>
                                <input type="text" required name="name" placeholder="Enter ingredient" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" required name="slug" placeholder="Enter slug" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Quantity</label>
                                <input type="number"  name="qty" placeholder="Enter Quantity" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Measurement</label>
                                <input type="text"  name="measurement" placeholder="Per" class="form-control mb-2">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Status</label> <br>
                                <input type="checkbox"  name="status">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" name="add_inventory_btn">Save</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>