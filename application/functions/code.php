<?php
include('userfunctions.php'); 

if(isset($_POST['checking_viewbtn'])){
    $p_name = $_POST['productName'];
    
    $query = "SELECT * FROM products WHERE name='$p_name'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
            echo $return = '
                <h5>Name: '.$row['name'].'</h5>
                <h5>Desc: '.$row['description'].'</h5>
                <h5>Price: '.$row['selling_price'].'</h5>
            ';
        }
    }
    else{
        echo $return = "<h5>No record</h5>";
    }
}


?>