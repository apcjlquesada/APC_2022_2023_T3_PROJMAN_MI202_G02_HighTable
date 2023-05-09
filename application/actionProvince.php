<?php
require 'config/dbcon.php';
$output = '';
$sql = "SELECT * FROM province WHERE region_id='".$_POST['regionID']."' ORDER BY name";
$result = mysqli_query($con, $sql);
$output .='<option value="" disabled selected>Select Province</option>';

while($row = mysqli_fetch_array($result)){
    $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
}
echo $output;


?>