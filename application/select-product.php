<?php
include('functions/userfunctions.php');
include('config/dbcon.php');


if(isset($_POST["prod_id"])){
    $output = '';
    
    $query = "SELECT * FROM products WHERE id = '".$_POST["prod_id"]."'";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)){
        $output .= '

        <div class="selectProductImage">
            <button type="button" class="closeBtn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            <img src="uploads/'. $row['image'].'" alt="Product Image" class="w-100">
        </div>
        <div class="container product_data">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold">'. $row['name'].'
                    </h4>
                    <hr>
                    <h6 class="fw-bold">Product Description</h6>
                    <p>'.$row['description'].'</p>
                </div>
                <div class="priceQty col-md-12">
                    <div class="col-md-6">
                        <h4><span class="pesoSign">₱ </span><span class="text-success fw-bold">'. $row['selling_price'].'</span></h4>
                    </div>
                    <div class="quantityBtn col-md-4">
                        <div class="input-group mb-3" style="width:130px">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                </div>
                    <button class="btn btn-primary px-4 addToCartBtn btn-green" value="'. $row['id'].'"><i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
            </div>
        </div>
    
    
        ';
    }
    echo $output;
    
    
}

?>