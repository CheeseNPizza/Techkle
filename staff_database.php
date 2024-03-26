<?php
//I change from "staff_db" to "order_db" to match with the existing database
    $con = mysqli_connect("localhost","root","","order_db");
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>