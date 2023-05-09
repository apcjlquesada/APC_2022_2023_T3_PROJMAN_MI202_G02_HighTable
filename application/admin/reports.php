<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-success">
                    <h4 class="text-white print-head"> Sales Report
                        <a href="transaction.php" class="btn btn-outline-light float-end">Transaction Record</a>
                    </h4>
                </div>
                <div class="card-body row justify-content-center" id="">
                    <form class="row d-flex justify-content-center" action="" method="GET">
                        <div class="col-md-4">
                            <div class="form-control mb-4 p-2" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar px-1"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down px-1"></i>
                            </div>  
                        </div>  
                        <div class="col-md-3">
                            <button type="submit" id="selectDatesBtn" name="selectDatesBtn" class="btn btn-success">Show Sales from These Dates</button>
                                <input type="hidden" class="start" id="start" name="start">
                                <input type="hidden" class="end" id="end" name="end">
                        </div>
                                        
                        <div>
                            <table class="table table-bordered table-striped print-container">
                                <div class="print-container">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Sold</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>

                                    <script type="text/javascript">
                                        $(function() {

                                        var start = moment();
                                        var end = moment();
                                            
                                        function cb(start, end) {
                                            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                                            document.getElementById("start").value = start.format('YYYY-MM-DD');
                                            document.getElementById("end").value = end.format('YYYY-MM-DD');
                                            // document.getElementById("reportrange").submit();
                                        }
                                        
                                        $('#reportrange').daterangepicker({
                                            startDate: start,
                                            endDate: end,
                                            ranges: {
                                               'Today': [moment(), moment()],
                                               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                               'This Week': [moment().startOf('week'), moment().endOf('week')],
                                               'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
                                               'This Month': [moment().startOf('month'), moment().endOf('month')],
                                               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                               "This Year": [moment().startOf("year"), moment().endOf("year")],
                                               "Last Year": [moment().startOf("year").subtract(1, "year"), moment().endOf("year").subtract(1, "year")]
                                            }
                                        }, cb);
                                        
                                        cb(start, end);
                                    
                                        });

                                    </script>
                                        
                                    <?php                                        
                                        if(isset($_GET['start']) && isset($_GET['end'])){
                                            $date1 = $_GET['start'];
                                            $date2 = $_GET['end'];
        
                                            $query1 = "SELECT products.name AS name, SUM(order_items.qty) AS total_quantity, SUM(order_items.price * order_items.qty) AS total_order_price FROM order_items JOIN products ON order_items.prod_id = products.id WHERE date BETWEEN '$date1' AND '$date2' AND order_items.order_items_status!='3' GROUP BY products.name ORDER BY total_quantity DESC";
                                            $query2 = "SELECT SUM(price * qty) as total FROM order_items WHERE date BETWEEN '$date1' AND '$date2' AND order_items_status!='3'";
                                            
                                            $query_run = mysqli_query($con, $query1);  
        
                                            if(mysqli_num_rows($query_run) > 0){
                                                foreach ($query_run as $item) {
                                                ?>
                                                    <tr>
                                                    <td> <?= $item['name']; ?> </td>
                                                    <td style="text-align: right;"> <?= $item['total_quantity']; ?> </td>
                                                    <td style="text-align: right;"> <?= number_format(sprintf($item[('total_order_price')]), 2, '.', ','); ?> </td>
                                                    </tr>
                                                    <?php
                                            }
                                            $query_run = mysqli_query($con, $query2);
                                                    if (mysqli_num_rows($query_run) > 0) {
                                                        $row = mysqli_fetch_assoc($query_run);
                                                        $total = $row['total'];
                                                        ?> 
                                                        <div class="print-container">
                                                            <p class="mb-3 float-end print-text" style="font-size: 20px; font-weight: 400;">
                                                            Total sales between 
                                                            <?php echo "$date1"?> and <?php echo "$date2"?> is 
                                                            <span style="font-size: 25px;">
                                                            <strong>₱<?php echo number_format(sprintf("%.2f", $total), 2, '.', ','); ?></strong>
                                                            </span>
                                                            </p>
                                                        </div>
                                                        <?php 
                                                    }
                                            
                                        }else {
                                            ?>
                                            <p class="mb-3 float-end" style="font-size: 20px; font-weight: 400;">No sales found between the selected dates.</p>
                                            <?php 
                                        }
                                        }
                                    ?>
                                </div>
                            </table>
                        </div>
                        <div class="print-hide d-flex mt-3">               
                                    <button onclick="window.print()" class="btn btn-success">Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
