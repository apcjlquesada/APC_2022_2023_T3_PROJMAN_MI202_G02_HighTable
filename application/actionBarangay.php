<?php
require 'config/dbcon.php';
$output = '';
$sql = "SELECT * FROM barangay WHERE city_id='".$_POST['cityID']."' ORDER BY name";
$result = mysqli_query($con, $sql);
$output .='<option value="" disabled selected>Select Barangay</option>';

while($row = mysqli_fetch_array($result)){
    $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
}
echo $output;


?>