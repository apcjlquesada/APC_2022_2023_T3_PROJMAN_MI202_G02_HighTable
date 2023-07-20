<?php

session_start();
include('../config/dbcon.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_SESSION['auth']))
{
    if(isset($_POST['placeOrderBtn'])){
        $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($con, $_POST['last_name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        
        $delivery_date = mysqli_real_escape_string($con, $_POST['delivery_date']);
        $time = mysqli_real_escape_string($con, $_POST['time']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);
        $comments = mysqli_real_escape_string($con, $_POST['comments']);
        $totalPrice = mysqli_real_escape_string($con, $_POST['overallPrice']);            

            if($payment_mode == "GCash"){
                // split into comma separate array
            $option = explode(",", $_POST['option']);
                    
            // get value at first index
            $delivery_fee = $option[0];

            // get value at second index
            $region = $option[1];
            $province = $option[2];
            $city = $option[3];
            $barangay = $option[4];
            $house_number = $option[5];
            $street = $option[6];
            $landmark = $option[7];
            $postal_code = $option[8];
            }else{
                $delivery_fee = mysqli_real_escape_string($con, $_POST['delivery_fee']);
                $region = mysqli_real_escape_string($con, $_POST['region']);
                $province = mysqli_real_escape_string($con, $_POST['province']);
                $city = mysqli_real_escape_string($con, $_POST['city']);
                $barangay = mysqli_real_escape_string($con, $_POST['barangay']);
                $house_number = mysqli_real_escape_string($con, $_POST['house_number']);
                $street = mysqli_real_escape_string($con, $_POST['street']);
                $landmark = mysqli_real_escape_string($con, $_POST['landmark']);
                $postal_code = mysqli_real_escape_string($con, $_POST['postal_code']);
            }


        if($first_name == "" || $email == "" || $phone == ""){
            $_SESSION['message'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit(0);
        }

        $userid = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC ";
        
        $query_run = mysqli_query($con, $query);

        $ordersubTotal = 0;
            foreach ($query_run as $citem) {
                $ordersubTotal += $citem['selling_price'] * $citem['prod_qty'];

                
            }

        $tracking_no = date("Y").rand(111111,999999);
        $insert_query = "INSERT INTO orders (tracking_no, user_id, first_name, last_name, email, phone, region, province, city, barangay, house_number, street, landmark, postal_code, delivery_date, time, subtotal_price, total_price, payment_mode, payment_id, comments, delivery_fee) VALUES ('$tracking_no', '$userid', '$first_name', '$last_name', '$email', '$phone', '$region',' $province', '$city', '$barangay', '$house_number', '$street', '$landmark', '$postal_code', '$delivery_date', '$time', '$ordersubTotal', '$totalPrice', '$payment_mode', '$payment_id' , '$comments', '$delivery_fee')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run){
            $order_id = mysqli_insert_id($con);
            foreach ($query_run as $citem) 
            {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['selling_price'];

                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price' )";
                $insert_items_query_run = mysqli_query($con, $insert_items_query);

                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1 ";
                $product_query_run = mysqli_query($con, $product_query);

                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['qty'];
                $current_sales = $productData['sold'];

                $new_qty = $current_qty - $prod_qty;
                $new_sales = $current_sales + $prod_qty;

                $updateQty_query = "UPDATE products SET qty='$new_qty', sold='$new_sales' WHERE id='$prod_id' ";
                $updateQty_query_run = mysqli_query($con, $updateQty_query);
            }

            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userid' ";
            $deleteCartQuery_run = mysqli_query($con, $deleteCartQuery);
//Load Composer's autoloader
require '../vendor/autoload.php';
            if($payment_mode == "GCash"){
                
                $mail = new PHPMailer(true);

                $mail->isSMTP();                                            //Send using SMTP
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->Username   = 'rysalw4m@gmail.com';                     //SMTP username
                $mail->Password   = 'miawearustjppfkt';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;       

                $mail->setFrom('rysalw4m@gmail.com');
                $mail->addAddress($email);     //Add a recipient

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Order No. {$tracking_no} Placed Successfully" ;

                $email_template = "
                <!doctype html>
                    <html lang='en'>
                    <head>
                        <!--Required meta tags -->
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <title>Chubby Gourmet</title>

                        <!--Bootstrap CSS -->
                        <link href='assets/css/bootstrap.min.css' rel='stylesheet'>
                        <link href='assets/css/design.css' type='text/css' rel='stylesheet'>
                        <link href='assets/css/custom.css' rel='stylesheet'>

                        <!-- font awesome cdn link  -->
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
                        
                        <link href='assets/css/owl.theme.default.min.css' rel='stylesheet'>
                        <link href='assets/css/owl.carousel.min.css' rel='stylesheet'>

                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

                        <link rel='preconnect' href='https://fonts.googleapis.com'>
                        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
                        <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>

                        <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/>
                        <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css'/>
                        
                    </head>
                        <body>
                            <div>
                                <img src='http://drive.google.com/uc?export=view&id=1ki9fKeqLcG2SyW6CpBVwAv5Hw2E-FWM0' alt='Chubby Gourmet' width='150px'>
                            </div>
                            <h2 class='m-5' style='color: green;'>Good day!</h2>
                            <h3 class='m-5' style='color: black;'>Order No. $tracking_no</h3>
                            <p class='m-4' style='color:black;'>Thank you for ordering. The status of your order is now <strong>Processing</strong>.
                        
                            </p>
                            <hr>
                            <p class='m-4' style='color:black;'>You may view your orders by clicking the button below.</p>
                            <div style='display: flex; justify-content:center;'>
                                <a style='text-align: center;
                                background-color: green;
                                color: #fff;
                                padding: 0.5rem;
                                border-radius: 0.5rem;
                                text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table/High-Table-master/CG-Webapp-main/my-orders.php'>View My Orders</a>
                            </div>
                            <p class='m-4' style='color:black;'>Send us an email if you have other concerns. We are willing to help!</h6>
                            <p class='m-4' style='color:black;'>Cheers,</h6>
                            <p class='m-4' style='color:black;'>Chubby Gourmet</h6>




                        </body>
                </html>
                ";

                $mail->Body    = $email_template;

                $mail->send();
                $_SESSION['message'] = "Order placed successfully";
                header('Location: ../thankyou.php');
                die();
            }
            else{
                $mail = new PHPMailer(true);

                $mail->isSMTP();                                            //Send using SMTP
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->Username   = 'rysalw4m@gmail.com';                     //SMTP username
                $mail->Password   = 'miawearustjppfkt';                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;       

                $mail->setFrom('rysalw4m@gmail.com');
                $mail->addAddress($email);     //Add a recipient

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "Order No. {$tracking_no} Placed Successfully" ;

                $email_template = "
                <!doctype html>
                    <html lang='en'>
                    <head>
                        <!--Required meta tags -->
                        <meta charset='utf-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <title>Chubby Gourmet</title>

                        <!--Bootstrap CSS -->
                        <link href='assets/css/bootstrap.min.css' rel='stylesheet'>
                        <link href='assets/css/design.css' type='text/css' rel='stylesheet'>
                        <link href='assets/css/custom.css' rel='stylesheet'>

                        <!-- font awesome cdn link  -->
                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'>
                        
                        <link href='assets/css/owl.theme.default.min.css' rel='stylesheet'>
                        <link href='assets/css/owl.carousel.min.css' rel='stylesheet'>

                        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>

                        <link rel='preconnect' href='https://fonts.googleapis.com'>
                        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
                        <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>

                        <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css'/>
                        <link rel='stylesheet' href='//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css'/>
                        
                    </head>
                        <body>
                            <div>
                                <img src='http://drive.google.com/uc?export=view&id=1ki9fKeqLcG2SyW6CpBVwAv5Hw2E-FWM0' alt='Chubby Gourmet' width='150px'>
                            </div>
                            <h2 class='m-5' style='color: green;'>Good day!</h2>
                            <h3 class='m-5' style='color: black;'>Order No. $tracking_no</h3>
                            <p class='m-4' style='color:black;'>Thank you for ordering. The status of your order is now <strong>Processing</strong>.
                        
                            </p>
                            <hr>
                            <p class='m-4' style='color:black;'>You may view your orders by clicking the button below.</p>
                            <div style='display: flex; justify-content:center;'>
                                <a style='text-align: center;
                                background-color: green;
                                color: #fff;
                                padding: 0.5rem;
                                border-radius: 0.5rem;
                                text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table/High-Table-master/CG-Webapp-main/my-orders.php'>View My Orders</a>
                            </div>
                            <p class='m-4' style='color:black;'>Send us an email if you have other concerns. We are willing to help!</h6>
                            <p class='m-4' style='color:black;'>Cheers,</h6>
                            <p class='m-4' style='color:black;'>Chubby Gourmet</h6>




                        </body>
                </html>
                ";

                $mail->Body    = $email_template;

                $mail->send();
                echo 201;
                
            }
        }
    }
}
else{
    header('Location: ../index.php');
}
?>