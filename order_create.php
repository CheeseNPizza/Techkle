<?php
include("auth.php");
require("database.php");

$customer_ID = $_SESSION['customer_ID'];

$check_query = "SELECT * FROM `order` WHERE status = 'Pending' AND user_ID = $customer_ID";
$check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));
$check_row = mysqli_fetch_assoc($check_result);
if ($check_row == NULL) {

    $status = "Pending";
    $created_at = date("Y-m-d H:i:s");

    $ins_query = "INSERT INTO `order` (`user_ID`, `status`, `created_at`) 
                    VALUES ('$customer_ID', '$status', '$created_at')";

    mysqli_query($con, $ins_query) or die(mysqli_error($con));
    header("Location: order.php");
    exit();
} else {
    header("Location: order.php");
    exit();
}
?>
