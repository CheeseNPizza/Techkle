<?php
include("admin_auth.php");
require("database.php");

if(isset($_GET['order_ID'])) {
    $order_ID = $_GET['order_ID'];
    $query = "DELETE FROM `order` WHERE order_ID = $order_ID";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    header("Location: admin_order.php");
    exit();
}
?>