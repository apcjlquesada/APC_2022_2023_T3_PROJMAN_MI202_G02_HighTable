<?php
session_start();
include('../config/dbcon.php');

function getAll($table){
    global $con;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($con, $query);
}

function getByID($table, $id){
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id'";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message){
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function getAllOrders(){
    global $con;
    $query = "SELECT o.*, u.first_name, u.last_name FROM orders o, user u WHERE status='0' AND o.user_id=u.id ORDER BY created_at DESC";
    return $query_run = mysqli_query($con, $query);
}

function getAllAddress(){
    global $con;
    $query = "SELECT * FROM address WHERE status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getArchiveAddress(){
    global $con;
    $query = "SELECT * FROM address WHERE status='1'";
    return $query_run = mysqli_query($con, $query);
}

function getTodaysOrders(){
    global $con;
    $query = "SELECT o.*, u.first_name, u.last_name FROM orders o, user u WHERE status='0' AND date=curdate() AND o.user_id=u.id";
    return $query_run = mysqli_query($con, $query);
}

function getAllFAQs(){
    global $con;
    $query = "SELECT question, answer FROM faqs";
    return $query_run = mysqli_query($con, $query);
}

function getAllProducts(){
    global $con;
    $query = "SELECT * FROM products p WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getAllSoldProducts(){
    global $con;
    $query = "SELECT * FROM products p ORDER BY sold DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistory(){
    global $con;
    $query = "SELECT *, u.first_name, u.last_name FROM orders o, user u WHERE status !='0' AND o.user_id=u.id ORDER BY date DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistoryShipping(){
    global $con;
    $query = "SELECT *, u.first_name, u.last_name FROM orders o, user u WHERE status ='1' AND o.user_id=u.id ORDER BY date DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistoryCompleted(){
    global $con;
    $query = "SELECT *, u.first_name, u.last_name FROM orders o, user u WHERE status ='2' AND o.user_id=u.id ORDER BY date DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOrderHistoryCancelled(){
    global $con;
    $query = "SELECT *, u.first_name, u.last_name FROM orders o, user u WHERE status ='3' AND o.user_id=u.id ORDER BY date DESC";
    return $query_run = mysqli_query($con, $query);
}

function checkTrackingNoValid($trackingNo){
    global $con;
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' ";
    return mysqli_query($con, $query);
}

?>
