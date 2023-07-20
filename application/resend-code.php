<?php
session_start();
include('config/dbcon.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function resend_email_verify($name,$email,$verify_token){
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
    $mail->Subject = 'Resend - Email Verification';

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
                text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table-master/CG-Webapp-main/verify-email.php?token=$verify_token'>Verify Email Address</a>
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


if(isset($_POST['resend_email_verify_btn'])){
    if(!empty(trim($_POST['email']))){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $checkemail_query = "SELECT * FROM user WHERE email='$email'";
        $checkemail_query_run = mysqli_query($con, $checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0){
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0"){
                $first_name = $row['first_name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($name,$email,$verify_token);

                $_SESSION['message'] = "Email verification has been sent";
                header("Location: login.php");
                exit(0);
            }
            else{
                $_SESSION['message'] = "Email already verified. Please login";
                header("Location: login.php");
                exit(0);
            }
        }
        else{
            $_SESSION['message'] = "Email is not registered. Please register";
            header("Location: register.php");
            exit(0);
        }
    }
    else{
        $_SESSION['message'] = "Please enter your email address";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}


?>