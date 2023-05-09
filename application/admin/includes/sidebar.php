<?php

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);


?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-muted" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" area-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="index.php" target="">
        <!-- <img class="align-items-center cgwhite" src="assets/img/cgwhite.png" alt=""> -->
        <span class="text-head ms-3 font-weight-bold text-success">Chubby Gourmet</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "index.php"? 'active bg-gradient-success':''; ?>" href="index.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "category.php"? 'active bg-gradient-success':''; ?>" href="category.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">category</i>
            </div>
            <span class="nav-link-text ms-1">Categories</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "products.php"? 'active bg-gradient-success':''; ?>" href="products.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">local_mall</i>
            </div>
            <span class="nav-link-text ms-1">Products</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "inventory.php"? 'active bg-gradient-success':''; ?>" href="inventory.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">inventory_2</i>
            </div>
            <span class="nav-link-text ms-1">Inventory</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "orders.php"? 'active bg-gradient-success':''; ?>" href="orders.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">sell</i>
            </div>
            <span class="nav-link-text ms-1">Orders</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "reports.php"? 'active bg-gradient-success':''; ?>" href="reports.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">leaderboard</i>
            </div>
            <span class="nav-link-text ms-1">Reports</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "faqs.php"? 'active bg-gradient-success':''; ?>" href="faqs.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">question_mark</i>
            </div>
            <span class="nav-link-text ms-1">FAQs</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-success <?= $page == "address.php"? 'active bg-gradient-success':''; ?>" href="address.php">
            <div class="text-success text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">location_on</i>
            </div>
            <span class="nav-link-text ms-1">Address</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-success mt-4 w-100" href="../logout.php">Logout</a>
      </div>
    </div>
  </aside>