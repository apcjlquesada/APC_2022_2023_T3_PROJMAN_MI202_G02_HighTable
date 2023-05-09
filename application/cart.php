<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>

<div class="py-3">
    <div class="container">
        <h6>
            <a href="index.php">Home / </a>
            <a href="cart.php">Cart</a>
        </h6>
    </div>
</div>
    
<div class="py-5">
    <div class="cartContainer container">
        <div class="">
            <div class="cartRow row">
                <div class="col-md-12">
                    <div id="mycart">
                    <?php $items = getCartItems();
                        if(mysqli_num_rows($items) > 0) {
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Product</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Price</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Quantity</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Total</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Remove</h6>
                                </div>
                            </div>
                            <div id="product">
                                <?php
                                 $total = 0;
                                    foreach ($items as $citem) {
                                        $total = $total + ($citem['selling_price']* $citem['prod_qty']); ?>
                                        
                                            <div class="card product_data shadow-sm mb-3">
                                                <div class="row align-items-center">
                                                    <div class="col-md-2">
                                                        <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="80px">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5><?= $citem['name'] ?></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5 class="iprice" value="<?= $citem['selling_price'] ?>">₱<?= $citem['selling_price'] ?></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                                        <div class="input-group mb-3" style="width:130px">
                                                            <button class="input-group-text decrement-btn updateQty" onClick="refreshPage()">-</button>
                                                            <input type="text" class="iquantity form-control text-center input-qty bg-white" value="<?= $citem['prod_qty'] ?>" disabled>
                                                            <button class="input-group-text increment-btn updateQty" onClick="refreshPage()">+</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php $itemTotal = $citem['selling_price']* $citem['prod_qty'] ?>
                                                        <h5 class="itotal">₱<?= number_format($itemTotal,2) ?></h5>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-danger btn-sm deleteItem" value="<?= $citem['cid'] ?>">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                    }    
                                ?>
                            </div>
                                <div class="subtotalRow row">
                                    <div class="col-md-6">
                                        <h5>Subtotal</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 id="gtotal">₱<?= number_format($total,2)?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Delivery Fee</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Delivery fee will be shown during checkout</p>
                                    </div>
                                    <div class="col-md-12">
                                    <a href="category.php" class="btn continueshopBtn">Continue Shopping</a>
                                        <a href="checkout.php" class="btn btn-primary checkoutBtn">Proceed to checkout</a>

                                    </div>
                                </div>
                         
                        <?php
                        }else{
                            ?>
                            <div class="py-5">
                                <div class="container empty-cart">
                                    <div class="hero-row">
                                        <div class="column1">
                                            <h1>Your cart is empty!</h1>
                                            <p>Once you add-to-card a dish, you will see it here.</p>
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
</div>


    
<?php include('includes/footer.php');  ?>   