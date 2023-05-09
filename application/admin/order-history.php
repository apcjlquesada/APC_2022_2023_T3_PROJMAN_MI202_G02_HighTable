<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Order History - Shipping
                        <a href="orders.php" class="btn btn-outline-light float-end mx-1"><i class="fa fa-reply"></i> Back</a>
                        <a href="order-cancelled.php" class="btn btn-outline-light float-end mx-1">Cancelled Orders</a>
                        <a href="order-completed.php" class="btn btn-outline-light float-end mx-1">Completed Orders</a>
                    </h4>
                </div>
                <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Tracking Number</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getOrderHistoryShipping();

                                if(mysqli_num_rows($orders) > 0){
                                    foreach ($orders as $item) {
                                    ?>
                                        <tr>
                                            <td> <?= $item['first_name']; ?> <?= $item['last_name']; ?> </td>
                                            <td> <?= $item['tracking_no']; ?> </td>
                                            <td> <?= number_format($item['total_price'],2); ?> </td>
                                            <td> <?= $item['updated_at']; ?> </td>
                                            <td> <?php 
                                                if($item['status'] == 0 ){
                                                    echo "Processing";
                                                }else if($item['status'] == 1 ){
                                                    echo "In transit";
                                                }else if($item['status'] == 2 ){
                                                    echo "Completed";
                                                }else if($item['status'] == 3 ){
                                                    echo "Cancelled";
                                                }
                                            ?></td>
                                            <td>
                                                <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-success">View details</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }else{
                                    ?>
                                        <tr>
                                            <td colspan="5">No order history.</td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<?php include('includes/footer.php');  ?>   