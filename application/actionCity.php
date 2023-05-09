<?php
require 'config/dbcon.php';
$output = '';
$sql = "SELECT * FROM city WHERE province_id='".$_POST['provinceID']."' ORDER BY name";
$result = mysqli_query($con, $sql);
$output .='<option value="" disabled selected>Select City</option>';

while($row = mysqli_fetch_array($result)){
    $output .= '<option value="'.$row["id"].'">'.$row["name"].'</option>';
}
echo $output;


?>