<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3">
    <div class="container">
        <h6>
            <a href="index.php">Home / </a>
            <a href="my-orders.php">My Orders</a>
        </h6>
    </div>
</div>
    
<div class="py-5">
    <div class="container">
        <div class="row row-cols-md-8">
                <div class="col m-2 text-center orderStatusBtnActive">
                    <a href="my-orders.php" class="text-white">Processing</a>
                </div>
                <div class="col m-2 text-center orderStatusBtn">
                    <a href="shipping-orders.php">Shipping</a>
                </div>
                <div class="col m-2 text-center orderStatusBtn">
                    <a href="complete-orders.php">Completed</a>
                </div>
                <div class="col m-2 text-center orderStatusBtn">
                    <a href="cancelled-orders.php">Cancelled</a>
                </div>
        </div>
        <div class="">
            <div class="myOrderRow row mt-3">
                <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Tracking Number</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="float-end">Price</h6>
                            </div>
                            <div class="col-md-3">
                                <h6 class="float-end">Date Placed</h6>
                            </div>
                            <div class="col-md-2">
                                <h6 class="float-end">View</h6>
                            </div>
                        </div>
                        <?php
                            $orders = getProcessingOrders();
                            if(mysqli_num_rows($orders) > 0){
                                foreach ($orders as $item) {
                                ?>
                            
                                <div class="myOrderCard card shadow-sm mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <?= $item['tracking_no']; ?>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="float-end">₱ <?= number_format($item['total_price'],2); ?></span>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="float-end"><?= $item['created_at']; ?></span>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="float-end"><a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary btn-green viewOrder">View details</a></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                            }else{
                                ?>
                                <div class="py-5">
                                    <div class="container">
                                        <div class="hero-row">
                                            <div class="column1">
                                                <h1>No orders found!</h1>
                                                <p>Once you place an order, you will see it here.</p>
                                                <a class="btn btn-primary btn-green hero-btn" href="category.php">Shop Now</a>
                                            </div>
                                            <div class="column2">
                                                <img src="assets/images/cg-cart.png" alt="banner" width="500px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<?php include('includes/footer.php');  ?>   