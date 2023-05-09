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
                    $inventory = getByID('inventory',$id);

                    if(mysqli_num_rows($inventory) > 0){
                        $data = mysqli_fetch_array($inventory);
                        ?>
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="text-white">Edit Inventory
                                    <a href="inventory.php" class="btn btn-outline-light float-end"><i class="fa fa-reply"></i> Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <div class="col-md-6">
                                            <label class="mb-0">Name</label>
                                            <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="Enter ingredient" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="mb-0">Slug</label>
                                            <input type="text" required name="slug" value="<?= $data['slug']; ?>" placeholder="Enter slug" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Quantity</label>
                                            <input type="number"  name="qty" value="<?= $data['qty']; ?>" placeholder="Enter Quantity" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Measurement</label>
                                            <input type="text"  name="measurement" value="<?= $data['measurement']; ?>" placeholder="Per" class="form-control mb-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0">Status</label> <br>
                                            <input type="checkbox"  name="status" <?= $data['status'] == '0'?'':'checked' ?>>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success" name="update_inventory_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <?php
                    }
                    else{
                        echo "Ingredient not found";
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