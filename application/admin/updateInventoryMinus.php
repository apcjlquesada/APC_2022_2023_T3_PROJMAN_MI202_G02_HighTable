<?php
    include('../functions/myfunctions.php'); 

    $inventory = getAll("inventory");
    
    if(isset($_POST['id'], $_POST['qty'])){
        $id = $_POST['id'];
        $qty = $_POST['qty'];
    
        $query = "UPDATE inventory SET qty = qty - '$qty', updated_at=NOW() WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if($result){
            $updated_qty = getQty($id);
            if($updated_qty < 0){
                $query = "UPDATE inventory SET qty = 0, updated_at=NOW() WHERE id = '$id'";
                mysqli_query($con, $query);
                echo 0;
            }
            else{
                echo $updated_qty;
            }
        }
        else{
            echo "Error: " . mysqli_error($con);
        }
    }
    else{
        echo "Error: required data not found";
    }
    
    function getQty($id){
        global $con;
        $query = "SELECT qty FROM inventory WHERE id = '$id'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            return $row['qty'];
        }
        return 0;
    }
?>