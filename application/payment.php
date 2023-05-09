<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

?>


<div class="py-3">
    <div class="container">
        <h6>
            <a href="index.php">Home / </a>
            <a href="checkout.php">Checkout / </a>
            <a href="payment.php">Payment</a>
        </h6>
    </div>
</div>
    
<div class="py-5">
    <div class="checkoutContainer container">
        <div class="card">
            <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">
                <div class="row">
                        <div class="col-md-6">
                            <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                $sql = "SELECT * FROM user WHERE email = '$currentUser'";

                                $gotResults = mysqli_query($con, $sql);

                                if($gotResults){
                                    if(mysqli_num_rows($gotResults) > 0){
                                        while($row = mysqli_fetch_array($gotResults)){
                                            ?>
                            <h4>Delivery Details</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $row["first_name"] ?>" required>
                                    
                                </div>
                                
                                <div class="col-md-12 payment">
                                    <h4>Payment Options</h4>
                                    <hr>
                                    <div class="accordion mt-3 mb-3" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                PayPal/Debit Card/Credit Card
                                            </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <!-- Set up a container element for the button -->
                                                    <div id="paypal-button-container" class="mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                GCash
                                            </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="col-md-12">
                                                        <h6>Instruction</h6>
                                                        <p>GCash Account Name: Priscilla Mariano</p>
                                                        <p>GCash Account Number: 09123456789</p>
                                                        <label class="form-label mb-0">Reference Number</label>
                                                        <input type="text"  name="payment_id" class="form-control mb-2" maxlength="13" pattern="[0-9]{13}" required>
                                                    </div>
                                                    <div class="">
                                                        <input type="hidden" name="payment_mode" value="GCash">
                                                        <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Order Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                            <?php
                                            
                                        }
                                    }
                                }

?>        
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
                                    <?php $items = getCartItems();
                                        $ordersubTotal = 0;
                                        $totalPrice = 0;
                                        foreach ($items as $citem) {
                                    ?>
                                    <tr>
                                        <td class="productImage align-middle">
                                            <img src="uploads/<?= $citem['image'] ?>" alt="Image" width="60px">
                                            <?= $citem['name'] ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= $citem['selling_price'] ?>
                                        </td>
                                        <td class="align-middle">
                                            x <?= $citem['prod_qty'] ?>
                                        </td>
                                        <td class="align-middle">
                                            <?php $prodTotal = $citem['selling_price']* $citem['prod_qty'] ?>
                                            <?= number_format($prodTotal,2) ?>
                                        </td>
                                    </tr>
                                    <?php
                                        $ordersubTotal += $citem['selling_price'] * $citem['prod_qty'];
                                        
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h7>Subtotal <span class="float-end fw-bold" id="subtotal"><?= number_format($ordersubTotal,2) ?></span></h7>
                            <br><h7>Delivery Fee <span class="float-end fw-bold" id="fee">  </span></h7>
                            <hr>
                            <h5 class="fw-bold">Total (VAT Included) <span class="float-end fw-bold" name="totalPrice" id="totalPrice"></span></h5>
                            
                            
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
    
<?php include('includes/footer.php');  ?>   

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AaUn5OjyPnXMgvbk0-LXncwpXCWx40tYtPDYVdZRVgghBiJpkf074nSSmpf9xhOhT9PZa3HGOS-r7UoH&currency=PHP"></script>
<script>
  function getSelectedValue(){
    var selectedFee = document.getElementById("delivery_fee").value;
    var feeResult = document.getElementById("fee");

    console.log(selectedFee);
   
    feeResult.textContent = selectedFee;
    //var selected = document.getElementById("region").value;
    //var feeresult = document.getElementById("fee");
    //var totalPrice = document.getElementById("totalPrice");
    //var ncrfee = 150;
    //var lagunafee = 110;
    //if(selected == "NATIONAL CAPITAL REGION (NCR)"){
    //  feeresult.textContent = ncrfee.toFixed(2);
    //  dfee = <?php echo $ordersubTotal ?>+ncrfee;
    //  totalPrice.textContent = dfee.toFixed(2);
    //}else{
    //  feeresult.textContent = lagunafee.toFixed(2);
    //  dfee = <?php echo $ordersubTotal ?>+lagunafee;
    //  totalPrice.textContent = dfee.toFixed(2);
    //}
  }
  getSelectedValue();
</script>
<script>

  paypal.Buttons({
        onClick(){
            console.log("click");
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var region = $('#region').val();
            var province = $('#province').val();
            var city = $('#city').val();
            var barangay = $('#barangay').val();
            var house_number = $('#house_number').val();
            var street = $('#street').val();
            var landmark = $('#landmark').val();
            var postal_code = $('#postal_code').val();
            var delivery_date = $('#delivery_date').val();
            var time = $('#time').val();
            var comments = $('#comments').val();

            if(delivery_date.length == 0){
                $('.delivery_date').text("*Delivery Date is required");
            }else{
                $('.delivery_date').text("");
            }
            if(time.length == 0){
                $('.time').text("*Time is required");
            }else{
                $('.time').text("");
            }
            if(delivery_date.length == 0 || time.length == 0){
                return false;
            }
        },
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        console.log("create");
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: totalPrice.textContent // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
          console.log(orderData);
          //console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          const transaction = orderData.purchase_units[0].payments.captures[0];
          //alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var region = $('#region').val();
            var province = $('#province').val();
            var city = $('#city').val();
            var barangay = $('#barangay').val();
            var house_number = $('#house_number').val();
            var street = $('#street').val();
            var landmark = $('#landmark').val();
            var postal_code = $('#postal_code').val();
            var delivery_date = $('#delivery_date').val();
            var time = $('#time').val();
            var comments = $('#comments').val();

            var data = {
                'first_name': first_name,
                'last_name': last_name,
                'email': email,
                'phone': phone,
                'region': region,
                'province': province,
                'city': city,
                'barangay': barangay,
                'house_number': house_number,
                'street': street,
                'landmark': landmark,
                'postal_code': postal_code,
                'delivery_date': delivery_date,
                'time': time,
                'payment_mode': "PayPal",
                'payment_id': transaction.id,
                'placeOrderBtn': true,
                'comments': comments,
            };

            $.ajax({
                type: "POST",
                url: "functions/placeorder.php",
                data: data,
                success: function (response){
                    if(response == 201){
                        alertify.success("Order Placed Successfully");
                        window.location.href = 'thankyou.php';
                    }else{
                        console.log(response);
                    }
                }
            });

          // When ready to go live, remove the alert and show a success message within this page. For example:
          // const element = document.getElementById('paypal-button-container');
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      }
    }).render('#paypal-button-container');
  </script>