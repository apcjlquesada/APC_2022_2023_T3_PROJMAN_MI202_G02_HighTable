<?php
session_start();
include('config/dbcon.php');

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $verify_query = "SELECT * FROM user WHERE verify_token='$token'";
    $verify_query_run = mysqli_query($con, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0){
        $row = mysqli_fetch_array($verify_query_run);
        if($row['verify_status'] == "0"){
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE user SET verify_status='1' WHERE verify_token='$clicked_token'";
            $update_query_run = mysqli_query($con, $update_query);
            if($update_query_run){
                $_SESSION['message'] = "Your account has been verified successfully";
                header("Location: login.php");
                exit(0);
            }else{
                $_SESSION['message'] = "Verification Failed";
                header("Location: login.php");
                exit(0);
            }
        }else{
            $_SESSION['message'] = "Email already verified. Please login";
            header("Location: login.php");
            exit(0);
        }
    }else{
        $_SESSION['message'] = "Token does not exist";
        header("Location: login.php");
    }
}else{
    $_SESSION['message'] = "Not Allowed";
    header("Location: login.php");
}


?>