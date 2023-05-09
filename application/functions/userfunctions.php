<?php
session_start();
include('config/dbcon.php');

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

function getAllActive($table){
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getAllPopular(){
    global $con;
    $query = "SELECT * FROM products WHERE popular='1' AND status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getSlugActive($table, $slug){
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);
}

function getAllFAQs(){
    global $con;
    $query = "SELECT question, answer FROM faqs";
    return $query_run = mysqli_query($con, $query);
}

function getProdByCategory($category_id){
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id){
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0' ";
    return $query_run = mysqli_query($con, $query);
}

function getCartItems(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userid' ORDER BY c.id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function getProcessingOrders(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userid' AND status=0 ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}
function getShippingOrders(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userid' AND status=1 ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}
function getCompletedOrders(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userid' AND status=2 ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}
function getCancelledOrders(){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE user_id='$userid' AND status=3 ORDER BY id DESC ";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message){
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

function checkTrackingNoValid($trackingNo){
    global $con;
    $userid = $_SESSION['auth_user']['user_id'];
    $query = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userid' ";
    return mysqli_query($con, $query);
}

?>