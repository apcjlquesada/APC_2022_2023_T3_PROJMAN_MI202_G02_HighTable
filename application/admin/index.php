<?php 
include('../middleware/adminMiddleware.php'); 
include('includes/header.php');


?>

<?php
$query = $con->query("
SELECT products.name AS name, SUM(order_items.qty) AS total_quantity FROM order_items JOIN products ON order_items.prod_id = products.id WHERE order_items_status!='3' GROUP BY prod_id ORDER BY total_quantity DESC LIMIT 5;
");

foreach($query as $item){
  $chart_products[] = $item['name'];
  $chart_sales[] = $item['total_quantity'];
}
?>

<?php
$query = $con->query("
  SELECT MONTHNAME(orders.date), COUNT(DISTINCT orders.id), SUM(order_items.price * order_items.qty) FROM orders JOIN order_items ON order_items.order_id = orders.id WHERE orders.status!=3 AND YEAR(orders.date)=year(curdate()) GROUP BY MONTH(orders.date);
");

foreach($query as $item){
  $chart_month[] = $item['MONTHNAME(orders.date)'];
  $chart_month_sales[] = $item['COUNT(DISTINCT orders.id)'];
  $chart_month_total[] = $item['SUM(order_items.price * order_items.qty)'];
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
          <!-- <div class="row mt-4">
            <div class="col-lg-7 position-relative z-index-2">
                    <div class="card card-plain mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                            </div>

                        </div>
                    </div>
                    </div>
                </div> -->

          <div class="row">
                <div class="col-lg-3 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                      <a href="orders.php" class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">sell</i>
                      </a>
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize">Pending Orders</p>
                        <h2 class="mb-0">
                          <?php
                            $orders = getAllOrders();
                            if($orders_total = mysqli_num_rows($orders))
                            {
                              echo $orders_total;
                            }else{
                              echo '-';
                            }
                          ?>
                        </h2>
                      </div>
                    </div>

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p> -->
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-3 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2 bg-transparent">
                      <a href="products.php" class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">local_mall</i>
                      </a>
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize ">Available Products</p>
                        <h2 class="mb-0 ">
                        <?php
                            $products = getAllProducts();
                            if($products_total = mysqli_num_rows($products))
                            {
                              // $products_query = "SELECT * FROM products WHERE status='0' ";
                              // $products_query_run = mysqli_num_rows($con, $products_query);
                              // if($products_query_run){
                              // }
                              echo $products_total;
                            }else{
                              echo 'No available products';
                            }
                          ?>
                        </h2>
                      </div>
                    </div>

                    <hr class="horizontal my-0 dark">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                      <a href="faqs.php" class="icon icon-lg icon-shape bg-gradient-warning shadow-warning shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">forum</i>
                      </a>
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize">Manage FAQs</p>
                        <h2 class="mb-0">
                        <?php
                            $faqs = getAllFAQs();
                            if($faqs_total = mysqli_num_rows($faqs))
                            {
                              echo $faqs_total;
                            }else{
                              echo '-';
                            }
                          ?>
                        </h2>
                      </div>
                    </div>

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-lg-3 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2 bg-transparent">
                      <a href="adminSettings.php" class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">settings</i>
                      </a>
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize ">Admin Settings</p>
                        <h2 class="mb-0 ">
                          <?= $_SESSION['auth_user']['first_name']?>
                        </h2>
                      </div>
                    </div>

                    <hr class="horizontal my-0 dark">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0 ">Just updated</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize">Top Selling Products</p>
                        <canvas id="Chart1"></canvas>
                        <script>
                          const chart1 = document.getElementById('Chart1');

                            new Chart(chart1, {
                              type: 'bar',
                              data: {
                                labels: <?php echo json_encode($chart_products) ?>,
                                datasets: [{
                                  label: 'No. of Sales (Overall)',
                                  data: <?php echo json_encode($chart_sales) ?>,
                                  backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                  ],
                                  borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                  ],
                                  borderWidth: 2
                                }]
                              },
                              options: {
                                indexAxis: 'y',
                                responsive: true,
                              }
                            });
                        </script>
                      </div>
                    </div>

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 col-sm-5">
                  <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize">Monthly Sales</p>
                        <canvas id="Chart2"></canvas>
                        <script>
                          const chart2 = document.getElementById('Chart2');

                          new Chart(chart2, {
                            type: 'bar',
                            data: {
                              labels: <?php echo json_encode($chart_month) ?>,
                              datasets: [{
                                label: 'Total Sales per Month',
                                data: <?php echo json_encode($chart_month_total) ?>,
                                borderColor: ['rgba(30, 110, 30)'],
                                backgroundColor: 'rgba(30, 110, 30)',
                                borderWidth: 2,
                                type: 'line',
                                yAxisID: 'ytotal'
                              }, {
                                label: 'No. of Transactions per Month',
                                data: <?php echo json_encode($chart_month_sales) ?>,
                                borderColor: ['rgba(60, 180, 60, 0.7)'],
                                backgroundColor: ['rgba(60, 180, 60, 0.2)'],
                                borderWidth: 2,
                                type: 'bar',
                                yAxisID: 'ysales'
                              }]
                            },
                            options: {
                              responsive: true,
                              scales: {
                                ytotal: {
                                  type: 'linear',
                                  position: 'left',
                                },
                                ysales: {
                                  type: 'linear',
                                  position: 'right',
                                gridLines: {
                                  drawOnChartArea: false,
                                },
                                ticks: {
                                  max: 100,
                                  min: 0
                                }
                              }
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                    </div>
                  </div>
                </div>


                <div class="col-lg-12 col-sm-5">
                  <div class="card ">
                    <div class="card-header p-3 pt-2">
                      <div class="text-end pt-1">
                        <p class="text-md mb-3 text-capitalize">Today's Orders</p>
                        <div class="px-4 text-start">
                          <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Payment Mode</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $orders = getTodaysOrders();

                                    if(mysqli_num_rows($orders) > 0){
                                        foreach ($orders as $item) {
                                        ?>
                                            <tr>
                                                <td> <?= $item['first_name']; ?> <?= $item['last_name']; ?> </td>
                                                <td> <?= $item['payment_mode']; ?> </td>
                                                <td> <?= $item['total_price']; ?> </td>
                                                <td> <?= $item['date']; ?> </td>
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

                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p> -->
                    </div>
                  </div>
                </div>

          </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>