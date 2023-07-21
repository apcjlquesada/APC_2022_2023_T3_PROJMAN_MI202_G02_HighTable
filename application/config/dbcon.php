<?php

    $servername = "192.168.150.213";
    $username = "mi202g02hightable";
    $password = "mi202g02hightable";
    $database = "mi202g02hightable";

    //Creating database connection
    $con = mysqli_connect($host, $username, $password, $database);

    //Check database connection
    if(!$con){
        die("Connection Failed: ". mysqli_connect_error());
    }
?>
