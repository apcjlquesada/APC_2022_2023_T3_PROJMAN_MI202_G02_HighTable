<?php 
include('../middleware/adminMiddleware.php');
include('includes/header.php'); 
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-white"> Products Report
                        <a href="reports.php" class="btn btn-outline-light float-end">Back</a>
                        <a href="reports.php" class="btn btn-outline-light float-end mx-3">Sales Report</a>
                    </h4>
                </div>
                <div class="card-body row justify-content-center" id="">
                    <div class="row">
                        <div>
                            <table class="table table-bordered table-striped print-container">
                                <div class="print-container">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Sold</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        $products = getAllSoldProducts();

                                            if(mysqli_num_rows($products) > 0){
                                                foreach($products as $item){
                                                    ?>
                                                        <tr>
                                                            <td style="width: 300px;"><?= $item['name'] ?></td>
                                                            <td style="width: 80px;">
                                                                <img src="../uploads/<?= $item['image'] ?>" width="80px" height="80px" alt="<?= $item['name'] ?>">
                                                            </td>
                                                            <td style="width: 130px;"><?= $item['status'] == '0'? "Available":"Unavailable"?></td>
                                                            <td style="width: 130px;"><?= $item['sold'] ?></td>
                                                        </tr>
                                                    <?php
                                                }
                                            }
                                            else{
                                                echo "No records found.";
                                            }
                                    ?>
                                </div>
                            </table>
                        </div>
                        <div class="print-hide d-flex mt-3">               
                                <button onclick="window.print()" class="btn btn-success">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>