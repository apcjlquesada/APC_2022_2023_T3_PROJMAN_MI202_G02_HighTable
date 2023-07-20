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

function send_password_reset($get_name,$get_email,$token){
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'rysalw4m@gmail.com';                     //SMTP username
    $mail->Password   = 'miawearustjppfkt';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;       

    $mail->setFrom('rysalw4m@gmail.com');
    $mail->addAddress($get_email);     //Add a recipient

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Reset Link';

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
        <p class='m-4' style='color:black;'>Kindly click the button below to create your new password.</p>
        <div style='display: flex; justify-content:center;'>
            <a style='text-align: center;
            background-color: green;
            color: #fff;
            padding: 0.5rem;
            border-radius: 0.5rem;
            text-decoration: none;' class='email-password-btn' href='http://localhost/High-Table-master/CG-Webapp-main/password-change.php?token=$token&email=$get_email'>Create New Password</a>
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


if(isset($_POST['password_reset_link'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['first_name'];
        $get_email = $row['email'];

        $update_token = "UPDATE user SET verify_token='$token' WHERE email='$get_email' LIMIT 1 ";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run){
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['message'] = "We emailed you a password reset link";
            header("Location: password-reset.php");
            exit(0);

        }else{
            $_SESSION['message'] = "Something Went Wrong. #1";
            header("Location: password-reset.php");
            exit(0);
        }
    }else{
        $_SESSION['message'] = "No email found";
        header("Location: password-reset.php");
        exit(0);
    }
}

if(isset($_POST['password_update'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if(!empty($token)){
        if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
            $check_token = "SELECT * FROM user WHERE verify_token='$token'";
            $check_token_run = mysqli_query($con, $check_token);
            
            if(mysqli_num_rows($check_token_run) > 0){
                if($new_password == $confirm_password){
                    $update_password = "UPDATE user SET password='$new_password' WHERE verify_token='$token'";
                    $update_password_run = mysqli_query($con, $update_password);

                    if($update_password_run){
                        $new_token = md5(rand());
                        $update_to_new_token = "UPDATE user SET verify_token='$new_token' WHERE verify_token='$token'";
                        $update_to_new_token_run = mysqli_query($con, $update_to_new_token);

                        $_SESSION['message'] = "Password updated successfully";
                        header("Location: login.php");
                        exit(0);  
                    }
                    else{
                        $_SESSION['message'] = "Update Failed. Something went wrong";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);   
                    }
                }
                else{
                    $_SESSION['message'] = "New Password and Confirm Password does not match";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);   
                }
            }
            else{
                $_SESSION['message'] = "Invalid Token";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);   
            }
        }
        else{
            $_SESSION['message'] = "All fields are required";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);    
        }
    }
    else{
        $_SESSION['message'] = "No Token available";
        header("Location: password-reset.php");
        exit(0);
    }
}


?>