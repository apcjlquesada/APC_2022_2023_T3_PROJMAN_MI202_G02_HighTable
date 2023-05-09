<?php

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);


?>

<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white">
  <div class="container">
    <a href="index.php"><img src="assets/images/chubbygourmet.png" class="cgLogo" alt="Chubby Gourmet Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbarList navbar-nav ms-auto">
        <a class="nav-link <?= $page == "index.php"? 'active':''; ?>" href="index.php">Home</a>
        <a class="nav-link <?= $page == "category.php"? 'active':''; ?>" href="category.php">Menu</a>
        <a class="nav-link <?= $page == "faqs.php"? 'active':''; ?>" href="faqs.php">FAQs</a>
        <a class="nav-link <?= $page == "cart.php"? 'active':''; ?>" href="cart.php">Cart</a>
        <?php
          if(isset($_SESSION['auth'])){
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?= $_SESSION['auth_user']['first_name']?>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="my-orders.php" class="btn btn-primary">My Orders</a>
                  </li>
                  <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            <?php
          }
          else{
            ?>
            <a class="nav-link <?= $page == "login.php"? 'active':''; ?>" href="login.php">Login</a>
            <?php
          }
           ?>
      </div>
    </div>
  </div>
</nav>