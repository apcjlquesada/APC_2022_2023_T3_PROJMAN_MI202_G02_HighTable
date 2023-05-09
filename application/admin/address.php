<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Address
                    <a href="archiveAddress.php" class="btn btn-outline-light float-end">Archive</a>
                    <a href="addAddress.php" class="btn btn-outline-light float-end mx-3">Add Address</a>
                    </h4>
                </div>
                <div class="card-body" id="address_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Province</th>
                                <th>City</th>
                                <th>Barangay</th>
                                <th>Delivery Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $address = getAllAddress("address");

                                if(mysqli_num_rows($address) > 0){
                                    foreach($address as $item){
                                        ?>
                                            <tr>
                                                <td><?= $item['province'] ?></td>
                                                <td><?= $item['city'] ?></td>
                                                <td><?= $item['barangay'] ?></td>
                                                <td><?= $item['delivery_fee'] ?></td>
                                                <td>
                                                    <a href="editAddress.php?id=<?= $item['id'] ?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                                else{
                                    echo "No records found.";
                                }
                            ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>