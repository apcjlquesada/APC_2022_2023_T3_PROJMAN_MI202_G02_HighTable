<?php
include('functions/userfunctions.php'); 

if(isset($_POST["action"])){
    $output = '';
    if($_POST["action"] == "region"){
        $query = "SELECT province FROM address WHERE region = '".$_POST["query"]."' GROUP BY province";
        $result = mysqli_query($con, $query);
        $output .= '<option value="" disabled selected>Select Province</option>';
        while($rows = mysqli_fetch_array($result)){
            $output .= '<option value ="'.$rows["province"].'">'.$rows["province"].'</option>';
        }
    }
    if($_POST["action"] == "province"){
        $query = "SELECT city FROM address WHERE province = '".$_POST["query"]."' GROUP BY city";
        $result = mysqli_query($con, $query);
        $output .= '<option value="" disabled selected>Select City</option>';
        while($rows = mysqli_fetch_array($result)){
            $output .= '<option value ="'.$rows["city"].'">'.$rows["city"].'</option>';
        }
    }
    if($_POST["action"] == "city"){
        $query = "SELECT barangay FROM address WHERE city = '".$_POST["query"]."'";
        $result = mysqli_query($con, $query);
        $output .= '<option value="" disabled selected>Select Barangay</option>';
        while($rows = mysqli_fetch_array($result)){
            $output .= '<option value ="'.$rows["barangay"].'">'.$rows["barangay"].'</option>';
        }
    }
    if($_POST["action"] == "barangay"){
        $query = "SELECT delivery_fee FROM address WHERE barangay = '".$_POST["query"]."'";
        $result = mysqli_query($con, $query);
        while($rows = mysqli_fetch_array($result)){
            $output .= '<option value ="'.$rows["delivery_fee"].'">'.$rows["delivery_fee"].'</option>';
        }
    }
    echo $output;
}


?>