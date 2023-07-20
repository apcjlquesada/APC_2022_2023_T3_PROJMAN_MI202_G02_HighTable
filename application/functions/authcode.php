<?php

include('../config/dbcon.php');
include('myfunctions.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

function sendemail_verify($first_name,$email,$verify_token){
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
    $mail->Subject = 'Email Verification';

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
            <p class='m-4' style='color:black;'>Kindly click the button below to verify your email address.</p>
            <div style='display: flex; justify-content:center;'>
                <a style='text-align: center;
                background-color: green;
                color: #fff;
                padding: 0.5rem;
                border-radius: 0.5rem;
                text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table/High-Table-master/CG-Webapp-main/verify-email.php?token=$verify_token'>Verify Email Address</a>
            </div>
            <p class='m-4' style='color:black;'>Send us an email if you have other concerns. We are willing to help!</h6>
            <p class='m-4' style='color:black;'>Cheers,</h6>
            <p class='m-4' style='color:black;'>Chubby Gourmet</h6>
    
    
    
    
        </body>
    </html>
    ";

    $mail->Body    = $email_template;

    $mail->send();
}




if(isset($_POST['register_btn'])){
    $first_name = mysqli_real_escape_string($con,$_POST['first_name']);
    $last_name = mysqli_real_escape_string($con,$_POST['last_name']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);
    $address_name = mysqli_real_escape_string($con,$_POST['address_name']);
    $region = mysqli_real_escape_string($con,$_POST['region']);
    $province = mysqli_real_escape_string($con,$_POST['province']);
    $city = mysqli_real_escape_string($con,$_POST['city']);
    $barangay = mysqli_real_escape_string($con,$_POST['barangay']);
    $delivery_fee = mysqli_real_escape_string($con,$_POST['delivery_fee']);
    $house_number = mysqli_real_escape_string($con,$_POST['house_number']);
    $street = mysqli_real_escape_string($con,$_POST['street']);
    $postal_code = mysqli_real_escape_string($con,$_POST['postal_code']);
    $landmark = mysqli_real_escape_string($con,$_POST['landmark']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $confirm_password = mysqli_real_escape_string($con,$_POST['confirm_password']);
    $verify_token = md5(rand());

    //Check if email already registered
    $check_email_query = "SELECT email FROM user WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email already registered";
        header('Location: ../register.php');
    }
    else{
        if($password == $confirm_password){
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            //Insert user data
            $insert_query = "INSERT INTO user (first_name,last_name,phone,region,province,city,barangay,house_number,street,postal_code,landmark,email,password,verify_token) VALUES ('$first_name','$last_name','$phone','$region','$province','$city','$barangay','$house_number','$street','$postal_code', '$landmark','$email','$password','$verify_token')";
            $insert_query_run = mysqli_query($con,$insert_query);
            if($address_name=''){
                
            }else{
                $address_name = "HOME";
            }
            $insert_address_query = "INSERT INTO user_address (email,address_name,region,province,city,barangay,house_number,street,postal_code,landmark,delivery_fee) VALUES ('$email','$address_name','$region','$province','$city','$barangay','$house_number','$street','$postal_code', '$landmark','$delivery_fee')";
            $insert_address_query_run = mysqli_query($con,$insert_address_query);
    
            if($insert_query_run && $insert_address_query_run){
                sendemail_verify("$first_name","$email","$verify_token");
                $_SESSION['message'] = "Registered Successfully! Please verify your email address";
                header('Location: ../login.php');
            }
            else{
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../register.php');
            }
        }
        else{
            $_SESSION['message'] = "Password do not match";
            header('Location: ../register.php');
        }
    }

   
}
else if(isset($_POST['login_btn'])){
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);    
        
        $login_query = "SELECT * FROM user WHERE email='$email'";
        $login_query_run = mysqli_query($con, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            $row = mysqli_fetch_array($login_query_run);
            $verify=password_verify($password,$row['password']);
            if($verify == 1){
                if($row['verify_status'] == "1"){
                    $_SESSION['auth'] = true;
        
                    $userid = $row['id'];
                    $username = $row['first_name'];
                    $useremail = $row['email'];
                    $role_as = $row['role_as'];
            
                    $_SESSION['auth_user'] = [
                        'user_id' => $userid,
                        'first_name' => $username,
                        'email' => $useremail
                    ];
            
                    $_SESSION['role_as'] = $role_as;
            
                    if($role_as == 1){
                        redirect("../admin/index.php", "Welcome to Dashboard");
                    }
                    else{
                        redirect("../index.php", "Logged In Successfully");
                    }
                }
                else{
                    $_SESSION['message'] = "Please verify your email address";
                    header('Location: ../login.php');
                }
            }
            else{
                redirect("../login.php", "Invalid Credentials");
            }
            
        }
        else{
            redirect("../login.php", "Invalid Credentials");
        }
    }
    else{
        $_SESSION['message'] = "All fields are required";
        header("Location: login.php");
        exit(0);
    } 
}

if(isset($_POST['update_profile_btn'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $postal_code = $_POST['postal_code'];
    $landmark = $_POST['landmark'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Check if email already registered
    //$check_email_query = "SELECT email FROM customer WHERE email='$email'";
    //$check_email_query_run = mysqli_query($con, $check_email_query);

    //if(mysqli_num_rows($check_email_query_run) > 0){
       // $_SESSION['message'] = "Email already registered";
        //header('Location: ../edit-profile.php');
   // }
   // else{
        if($password == $confirm_password){
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            //Insert user data
            $update_user_query = "UPDATE user SET first_name='$first_name',last_name='$last_name',phone='$phone',region='$region',province='$province',city='$city',barangay='$barangay',house_number='$house_number',street='$street',postal_code='$postal_code',landmark='$landmark',email='$email',password='$password' WHERE email='$email'";
            $update_user_query_run = mysqli_query($con,$update_user_query);
    
            if($update_user_query){
                $_SESSION['message'] = "Updated Successfully";
                header('Location: ../my-profile.php');
            }
            else{
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../edit-profile.php');
            }
        }
        else{
            $_SESSION['message'] = "Password do not match";
            header('Location: ../edit-profile.php');
        }
   // }
}
if(isset($_POST['add_useraddress_btn'])){
    $address_name = $_POST['address_name'];
    $email = $_POST['email'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $delivery_fee = $_POST['delivery_fee'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $postal_code = $_POST['postal_code'];
    $landmark = $_POST['landmark'];
    $status = isset($_POST['status']) ? '1':'0';


    if($address_name != ""){

        $adress_query = "INSERT INTO user_address (address_name,email,region,province,city,barangay,delivery_fee,house_number,street,postal_code,landmark,status) 
        VALUES ('$address_name','$email','$region','$province','$city','$barangay','$delivery_fee','$house_number','$street','$postal_code','$landmark','$status')";

        $adress_query_run = mysqli_query($con, $adress_query);
        $_SESSION['message'] = "Updated Successfully";
        header('Location: ../my-profile.php');
    }
    else{
        $_SESSION['message'] = "Updated Successfully";
        header('Location: ../addUserAddress.php');    }
}


if(isset($_POST['update_useraddress_btn'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $address_name = $_POST['address_name'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];
    $delivery_fee = $_POST['delivery_fee'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $postal_code = $_POST['postal_code'];
    $landmark = $_POST['landmark'];
    $status = isset($_POST['status']) ? '1':'0';

            $update_useraddress_query = "UPDATE user_address SET address_name='$address_name',region='$region',province='$province',city='$city',barangay='$barangay',delivery_fee='$delivery_fee',house_number='$house_number',street='$street',postal_code='$postal_code',landmark='$landmark',status='$status' WHERE email='$email' AND id='$id' ";
            $update_useraddress_query_run = mysqli_query($con,$update_useraddress_query);
    
            if($update_useraddress_query_run){
                $_SESSION['message'] = "Updated Successfully";
                header('Location: ../my-profile.php');
            }
            else{
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../editUserAddress.php');
            }
   // }
}



?>