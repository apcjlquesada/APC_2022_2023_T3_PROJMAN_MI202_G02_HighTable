<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');


?>

    
<div class="py-5">
    <div class="container">
        <div class="thankyou-row">
            <div class="column1">
                <h1>Thank You!</h1>
                <p class="mb-4">Your order has been placed.</p>
                <div class="thankyou-btn">
                    <a class="btn btn-primary btn-green hero-btn" href="my-orders.php">View My Orders</a> <a class="shopagain-btn" href="category.php">Shop Again</a>
                </div>
            </div>
            <div class="column2">
                <img src="assets/images/cg-thankyou.png" alt="banner" width="500px">
            </div>
        </div>
    </div>
</div>
    
<?php include('includes/footer.php');  ?>   