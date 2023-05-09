<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');
    
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card print-container orderCard">
                <div class="card-header bg-success">
                    <span class="text-white">Tracking No.</span>
                    <a href="orders.php" class="btn btn-outline-light float-end print-hide"><i class="fa fa-reply"></i> Back</a>
                    <h3 class="tracking-number text-white"><?= $data['tracking_no']; ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Customer Details</h4>
                            <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">First Name</label>
                                        <div class="border p-1">
                                            <?= $data['first_name']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Last Name</label>
                                        <div class="border p-1">
                                            <?= $data['last_name']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Email</label>
                                        <div class="border p-1">
                                            <?= $data['email']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Phone</label>
                                        <div class="border p-1">
                                            <?= $data['phone']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Region</label>
                                        <div class="border p-1">
                                            <?= $data['region']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Province</label>
                                        <div class="border p-1">
                                            <?= $data['province']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">City</label>
                                        <div class="border p-1">
                                            <?= $data['city']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Barangay</label>
                                        <div class="border p-1">
                                            <?= $data['barangay']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">House Number</label>
                                        <div class="border p-1">
                                            <?= $data['house_number']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Street Name</label>
                                        <div class="border p-1">
                                            <?= $data['street']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Nearest Landmark</label>
                                        <div class="border p-1">
                                            <?= $data['landmark']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Postal Code</label>
                                        <div class="border p-1">
                                            <?= $data['postal_code']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Delivery Date</label>
                                        <div class="border p-1">
                                            <?= $data['delivery_date']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Time</label>
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
                                    <h4>Payment Details</h4>
                                    <hr>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Payment Mode</label>
                                        <div class="border p-1">
                                            <?= $data['payment_mode']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="fw-bold">Reference Number</label>
                                        <div class="border p-1">
                                            <?= $data['payment_id']; ?>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered table-striped " >
                                <thead>
                                    <tr class="">
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM orders o, order_items oi, 
                                            products p WHERE oi.order_id=o.id AND p.id=oi.prod_id 
                                            AND o.tracking_no='$tracking_no' ";
                                        $order_query_run = mysqli_query($con, $order_query);

                                        if(mysqli_num_rows($order_query_run) > 0){
                                            foreach ($order_query_run as $item) {
                                                $ordersubTotal = 0;
                                                $totalPrice = 0;
                                                ?>
                                                    <tr >
                                                        <td class="align-middle">
                                                            <img src="../uploads/<?= $item['image'] ?>" width="50px" height="50px" alt="<?= $item['name'] ?>">
                                                            <?= $item['name'] ?>
                                                        </td>
                                                        <td class="align-middle">
                                                        ₱    <?= $item['price'] ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            x <?= $item['orderqty'] ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php $prodTotal = $item['price']* $item['orderqty'] ?>
                                                            ₱    <?= number_format($prodTotal,2) ?>
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
                            <h5>Total Price (VAT Included) <span class="float-end fw-bold">₱ <?= number_format($data['total_price'],2); ?></span></h5>
                            
                            <hr>
                            <!-- <label class="fw-bold">Payment Mode</label>
                            <div class="border p-1 mb-3">
                                <?= $data['payment_mode']; ?>
                            </div> -->
                            <label class="fw-bold">Status</label>
                            <div style="float:right;"><?= $data['updated_at']; ?></div>
                            <div class="mb-3">
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="tracking_no" value="<?= $data['tracking_no']; ?>">
                                    <input type="hidden" name="email" value="<?= $data['email']; ?>">
                                    <select name="order_status" class="form-control form-select p-2">
                                        <option value="0" <?= $data['status'] == 0?"selected":"" ?>>Processing</option>
                                        <option value="1" <?= $data['status'] == 1?"selected":"" ?>>Shipping</option>
                                        <option value="2" <?= $data['status'] == 2?"selected":"" ?>>Completed</option>
                                        <option value="3" <?= $data['status'] == 3?"selected":"" ?>>Cancelled</option>
                                    </select>
                                    <label class="form-label mb-0">Order Notice</label><br>
                                    <textarea class="col-md-12 p-2" name="notice" id="notice" col="10" rows="5"><?= $data['notice'] ?></textarea>
                                    <button type="submit" name="update_order_btn" class="btn btn-success mt-3 print-hide">Update Status</button>
                                </form>
                            </div>
                        </div>
                        <div class="print-hide d-flex justify-content-end">               
                                <button onclick="window.print()" class="btn btn-success">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<?php include('includes/footer.php');  ?>   