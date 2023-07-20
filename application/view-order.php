<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

if(isset($_GET['t'])){
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData) < 0){
        ?>
            <h4>Something went wrong</h4>
        <?php
        die();
    }

}else{
    ?>
        <h4>Something went wrong</h4>
    <?php
    die();
}

$data = mysqli_fetch_array($orderData);

?>

<div class="py-3">
    <div class="container">
        <h6>
            <a href="index.php">Home / </a>
            <a href="my-orders.php">My Orders /</a>
            <a href="#">View Orders</a>
        </h6>
    </div>
</div>
<div class="py-5">
    <div class="viewOrderContainer container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card print-container">
                        <span class="receipt receipt-head">
                            CHUBBY GOURMET
                        </span>
                        <p class="receipt receipt-p">
                            Address: Beverly Hills St, Don Jose, Santa Rosa, Laguna
                            <br> Tel. No: +852-98-76
                        </p>
                        <div class="card-header">
                            <span class="text-white">Tracking No.</span>
                            <a href="my-orders.php" class="btn btn-outline-light float-end print-hide"><i class="fa fa-reply"></i> Back</a>

                                <h3 class="tracking-number"><?= $data['tracking_no']; ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Customer Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">First Name</label>
                                            <div class="border p-1">
                                                <?= $data['first_name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Last Name</label>
                                            <div class="border p-1">
                                                <?= $data['last_name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Email</label>
                                            <div class="border p-1">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Contact Number</label>
                                            <div class="border p-1">
                                                0<?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Region</label>
                                            <div class="border p-1" id="region">
                                                <?= $data['region']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Province</label>
                                            <div class="border p-1">
                                                <?= $data['province']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">City</label>
                                            <div class="border p-1">
                                                <?= $data['city']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Barangay</label>
                                            <div class="border p-1">
                                                <?= $data['barangay']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">House Number</label>
                                            <div class="border p-1">
                                                <?= $data['house_number']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Street Name</label>
                                            <div class="border p-1">
                                                <?= $data['street']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Nearest Landmark</label>
                                            <div class="border p-1">
                                                <?= $data['landmark']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Postal Code</label>
                                            <div class="border p-1">
                                                <?= $data['postal_code']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Delivery Date</label>
                                            <div class="border p-1">
                                                <?= $data['delivery_date']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="form-label mb-0">Time</label>
                                            <div class="border p-1">
                                                <?= $data['time']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label mb-0">Note to Chef</label>
                                            <div class="border p-1">
                                                <?php
                                                if(!empty($data['comments'])){
                                                    echo $data['comments'];
                                                }else{
                                                    echo "None";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h4 class="mt-3">Payment Details</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label mb-0">Payment Mode</label>
                                                    <div class="border p-1">
                                                        <?= $data['payment_mode']; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label class="form-label mb-0">Reference Number</label>
                                                    <div class="border p-1">
                                                        <?= $data['payment_id']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $userid = $_SESSION['auth_user']['user_id'];

                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM orders o, order_items oi, 
                                                    products p WHERE o.user_id='$userid' AND oi.order_id=o.id AND p.id=oi.prod_id 
                                                    AND o.tracking_no='$tracking_no' ";
                                                $order_query_run = mysqli_query($con, $order_query);

                                                if(mysqli_num_rows($order_query_run) > 0){
                                                    foreach ($order_query_run as $item) {
                                                        ?>
                                                            <tr>
                                                                <td class="productImage align-middle ">
                                                                    <img class="print-hide" src="uploads/<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['name'] ?>">
                                                                    <?= $item['name'] ?>
                                                                </td>
                                                                <td class="align-middle">
                                                                ₱ <?= $item['price'] ?>
                                                                </td>
                                                                <td class="align-middle">
                                                                    x <?= $item['orderqty'] ?>
                                                                </td>
                                                                <td class="align-middle">
                                                                    <?php $prodTotal = $item['price']* $item['orderqty'] ?>
                                                                    ₱   <?= number_format($prodTotal,2) ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <h7>Subtotal <span class="float-end fw-bold" id="subtotal">₱ <?= number_format($data['subtotal_price'],2); ?></span></h7>
                                    <br><h7>Delivery Fee <span class="float-end fw-bold" id="fee">₱ <?= number_format($data['delivery_fee'],2); ?></span></h7>
                                    <hr>
                                    <h5 class="fw-bold">Total (VAT Included) <span class="float-end fw-bold">₱ <?= number_format($data['total_price'],2); ?></span></h5>
                                    
                                    <hr>
                                    <!-- <label class="fw-bold">Payment Mode</label>
                                    <div class="border p-1 mb-3">
                                        <?= $data['payment_mode']; ?>
                                    </div> -->
                                    <div class="order-status text-white">
                                        <label class="fw-bold">Status</label>
                                        <div style="float:right;"><?= $data['updated_at']; ?></div>
                                        <div class="border p-1 mb-3">
                                            <?php 
                                                if($data['status'] == 0 ){
                                                    echo "Processing";
                                                }else if($data['status'] == 1 ){
                                                    echo "In transit";
                                                }else if($data['status'] == 2 ){
                                                    echo "Completed";
                                                }else if($data['status'] == 3 ){
                                                    echo "Cancelled";
                                                }
                                            ?>
                                        </div>
                                        <?php
                                            if(!empty($data['notice'])){ ?>
                                                <div class="col-md-12 mb-2" id="notice">
                                                    <label class="form-label mb-0">Order Notice</label>
                                                    <div class="border p-1">
                                                        <?= $data['notice']; ?>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                            <script type="text/javascript">document.getElementById('notice').style.display = 'none';</script>
                                        <?php   } ?>
                                    </div>
                                    <div class="print-hide mb-3">               
                                            <button onclick="window.print()" class="btn btn-success mt-3">Print</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<?php include('includes/footer.php');  ?>   