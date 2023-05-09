<?php 
include('functions/userfunctions.php'); 
include('includes/header.php');
include('authenticate.php');

$cartItems = getCartItems();

if(mysqli_num_rows($cartItems) == 0){
    header('Location: category.php');
}
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>


<div class="py-3">
    <div class="container">
        <h6>
            <a href="index.php">Home / </a>
            <a href="checkout.php">Checkout</a>
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
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $row["last_name"] ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="<?= $row["email"] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mb-0">Contact Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">+63</div>
                                        </div>
                                        <input type="tel" required name="phone" id="phone" class="form-control mb-2" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" value="<?= $row['phone'] ?>">
                                    </div>
                                </div>
                                <!--<div class="col-md-6 mb-2">
                                        <?php
                                            $region = '';
                                            $query = "SELECT region FROM address GROUP BY region ORDER BY region ASC";
                                            $result = mysqli_query($con, $query);
                                            while($rows = mysqli_fetch_array($result)){
                                                $region .= '<option value="'.$rows["region"].'">'.$rows["region"].'</option>';
                                            }
                                        ?>
                                    <label class="form-label mb-0">Region</label>
                                    <select name="region" id="region" class="form-control action region" onchange=getSelectedValue() > 
                                        <option value="<?= $row["region"] ?>"><?= $row["region"] ?></option>
                                        <?php echo $region; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Province</label>
                                    <select name="province" id="province" class="form-control action">
                                        <option value="<?= $row["province"] ?>"><?= $row["province"] ?></option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">City</label>
                                    <select name="city" id="city" class="form-control action">
                                        <option value="<?= $row["city"] ?>"><?= $row["city"] ?></option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Barangay</label>
                                    <select name="barangay" id="barangay" class="form-control action">
                                        <option value="<?= $row["barangay"] ?>"><?= $row["barangay"] ?></option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">House Number</label>
                                    <input type="text"  name="house_number" id="house_number" class="form-control" value="<?= $row["house_number"] ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Street Name</label>
                                    <input type="text"  name="street" id="street" class="form-control" value="<?= $row["street"] ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Nearest Landmark</label>
                                    <input type="text"  name="landmark" id="landmark" class="form-control" value="<?= $row["landmark"] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mb-0">Zip Code</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control mb-2" maxlength="4" pattern="[0-9]{4}" value="<?= $row['postal_code'] ?>">
                                </div>-->
                                <label class="form-label mb-0">Address<a href="my-profile.php" class="float-end manageAddress">Manage Address</a></label>
                                

                                <div class="accordion mt-2 mb-3" id="accordionExample">
                                <?php
                                $currentUser = $_SESSION['auth_user']['email'];
                                $query = "SELECT * FROM user_address WHERE email='$currentUser' AND status=0";
                                $query_run = mysqli_query($con, $query);
                                $i=0;
                                while($item = mysqli_fetch_array($query_run)){
                                    if($i == 0){

                                    
                                        ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <input class="form-check-input m-1" type="radio" name="option" value="<?= $item['delivery_fee']?>, <?= $item['region']?>, <?= $item['province']?>, <?= $item['city']?>, <?= $item['barangay']?>, <?= $item['house_number']?>, <?= $item['street']?>, <?= $item['landmark']?>, <?= $item['postal_code']?>" id="option1" class="m-1" checked/><?= $item['address_name']?>
                                        </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Region</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['region']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Province</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['province']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">City</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['city']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Barangay</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['barangay']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">House Number</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['house_number']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Street</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['street']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Nearest Landmark</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['landmark']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label mb-0">Postal Code</label>
                                                        <div class="border p-2 mb-2">
                                                        <?= $item['postal_code']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }else{?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $item['id']; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $item['id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $item['id']; ?>">
                                            <input class="form-check-input m-1" type="radio" name="option" value="<?= $item['delivery_fee']?>, <?= $item['region']?>, <?= $item['province']?>, <?= $item['city']?>, <?= $item['barangay']?>, <?= $item['house_number']?>, <?= $item['street']?>, <?= $item['landmark']?>, <?= $item['postal_code']?>" id="option<?php echo $item['id']; ?>" class="m-1" /><?= $item['address_name']; ?>
                                            </button>
                                            </h2>
                                            <div id="collapse<?php echo $item['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $item['id'] ?>" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Region</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['region']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Province</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['province']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">City</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['city']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Barangay</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['barangay']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">House Number</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['house_number']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Street</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['street']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Nearest Landmark</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['landmark']; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label mb-0">Postal Code</label>
                                                            <div class="border p-2 mb-2">
                                                            <?= $item['postal_code']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php
                                            
                                        } $i++;
                                    }
                                ?>
                                </div>
                                
                                
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Delivery Date</label>
                                    <input type="date"  name="delivery_date" id="delivery_date" class="form-control" required />
                                    <small class="text-danger delivery_date"></small>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label mb-0">Delivery Time</label>
                                    <input type="time"  name="time" id="time" class="form-control" min="09:00" max="19:00" required />
                                    <small class="text-danger time"></small>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label mb-0">Note to Chef</label><br>
                                    <textarea class="col-md-12 p-2" name="comments" id="comments" col="10" rows="5"></textarea>
                                </div>
                                <div class="col-md-12 payment">
                                    <h4>Payment Options</h4>
                                    <hr>
                                    <div class="accordion mt-3 mb-3" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingA">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseA" aria-expanded="true" aria-controls="collapseA">
                                                PayPal/Debit Card/Credit Card
                                            </button>
                                            </h2>
                                            <div id="collapseA" class="accordion-collapse collapse show" aria-labelledby="headingA" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <!-- Set up a container element for the button -->
                                                    <div id="paypal-button-container" class="mt-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingB">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseB" aria-expanded="false" aria-controls="collapseB">
                                                GCash
                                            </button>
                                            </h2>
                                            <div id="collapseB" class="accordion-collapse collapse" aria-labelledby="headingB" data-bs-parent="#accordionExample">
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
                                                        <button type="submit" name="placeOrderBtn" class="btn btn-primary btn-green w-100">Order Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                       
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
                                        ₱<?= $citem['selling_price'] ?>
                                        </td>
                                        <td class="align-middle">
                                            x <?= $citem['prod_qty'] ?>
                                        </td>
                                        <td class="align-middle">
                                            <?php $prodTotal = $citem['selling_price']* $citem['prod_qty'] ?>
                                            ₱<?= number_format($prodTotal,2) ?>
                                        </td>
                                    </tr>
                                    <?php
                                        $ordersubTotal += $citem['selling_price'] * $citem['prod_qty'];
                                        
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h7>Subtotal <span class="float-end fw-bold" id="subtotal">₱<?= number_format($ordersubTotal,2) ?></span></h7>
                            <br><h7>Delivery Fee <span class="float-end fw-bold" id="fee">₱ <?= $row['delivery_fee'] ?></span></h7>
                            <hr>
                            <input type="hidden"  name="overallPrice" id="overallPrice" class="form-control"/>
                            <h5 class="fw-bold">Total (VAT Included) <span class="float-end fw-bold" name="totalPrice" id="totalPrice"></span></h5>
                            
                            
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container deliveryinfo-container">
        <div class="deliveryinfo-row">
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-location2.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Curated for the best experience in select locations.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-deliver.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Fresh, on-time delivery with scheduling options, no same-day delivery.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="column2 column2-deliveryinfo">
                    <img src="assets/images/cg-clock.png" alt="banner" width="300px">
                </div>
                <div class="column1 text-center">
                    <p>Delivery from 9AM-7PM for on-time and efficient service.</p>
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
<?php include('includes/footer.php');  ?>   

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id=AaUn5OjyPnXMgvbk0-LXncwpXCWx40tYtPDYVdZRVgghBiJpkf074nSSmpf9xhOhT9PZa3HGOS-r7UoH&currency=PHP"></script>
<script>
  let radioBtns = document.querySelectorAll("input[name='option']");
  let result = document.getElementById("fee");
  let totalPrice = document.getElementById("totalPrice");
 

  let findSelected = () => {
    let selected = document.querySelector("input[name='option']:checked").value;
    let selectedArray = selected.split(",");
    result.textContent = `₱${selectedArray[0]}`;
    console.log(selectedArray[0]);
    dfee = <?php echo $ordersubTotal ?>+Number(selectedArray[0]);
    totalPrice.textContent = dfee.toLocaleString("en-PH",{ style: "currency", currency: "PHP" });
    document.getElementById("overallPrice").value = dfee.toFixed(2);
}
  radioBtns.forEach(radioBtn => {
    radioBtn.addEventListener("change", findSelected);
  });
  findSelected();
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