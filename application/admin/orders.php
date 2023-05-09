<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
?>
    
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white">Orders
                        <a href="order-history.php" class="btn btn-outline-light float-end">Order History</a>
                    </h4>
                </div>
                <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Payment Mode</th>
                                <th>Payment ID</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $orders = getAllOrders();

                                if(mysqli_num_rows($orders) > 0){
                                    foreach ($orders as $item) {
                                    ?>
                                        <tr>
                                            <td> <?= $item['first_name']; ?> <?= $item['last_name']; ?> </td>
                                            <td> <?= $item['payment_mode']; ?> </td>
                                            <td> <?= $item['payment_id']; ?> </td>
                                            <td> <?= number_format($item['total_price'],2); ?> </td>
                                            <td> <?= $item['created_at']; ?> </td>
                                            <td>
                                                <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-success"><i class="fa-solid fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                }else{
                                    ?>
                                        <tr>
                                            <td colspan="5">No new orders.</td>
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