<?php
include("auth.php");
require("database.php");

// Get product ID to be inserted
$product_ID = $_GET['product_ID'];

// Check if there is no pending order
$check_query = "SELECT * FROM `order` WHERE status = 'Pending';";
$check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));
$check_row = mysqli_fetch_assoc($check_result);

if ($check_row == NULL) {
    // Create a new pending order
    $customer_ID = $_SESSION['customer_ID'];
    $status = "Pending";
    $created_at = date("Y-m-d H:i:s");

    $ins_query = "INSERT INTO `order` (`user_ID`, `status`, `created_at`) 
                    VALUES ('$customer_ID', '$status', '$created_at')";

    mysqli_query($con, $ins_query) or die(mysqli_error($con));
} 

// Retrieve order ID
$check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));
$check_row = mysqli_fetch_assoc($check_result);
$order_ID = $check_row['order_ID'];

// Retrieve product information
$product_query = "SELECT * FROM product WHERE id = $product_ID";
$product_result = mysqli_query($con, $product_query) or die(mysqli_error($con));
$product_row = mysqli_fetch_assoc($product_result);
$unit_price = $product_row['product_price'];

// Check if the order product already exists
$check_query = "SELECT * FROM order_product WHERE order_ID = $order_ID AND product_ID = $product_ID;";
$check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));
$check_row = mysqli_fetch_assoc($check_result);

if ($check_row != NULL) {
    // Update the quantity if the order product exists
    $new_quantity = $check_row['quantity'] + 1;
    $upd_query = "UPDATE order_product SET quantity = $new_quantity WHERE order_product_ID = '{$check_row['order_product_ID']}'";
    mysqli_query($con, $upd_query) or die(mysqli_error($con));
} else {
    // Insert new order product if it doesn't exist
    $ins_query = "INSERT INTO order_product (`order_ID`, `product_ID`, `quantity`, `unit_price`)
                  VALUES ('$order_ID', '$product_ID', '1', '$unit_price')";
    mysqli_query($con, $ins_query) or die(mysqli_error($con));

    // Update total price of the order
    $total_price = $unit_price;
    $upd_total_price_query = "UPDATE `order` SET total_price = '$total_price' WHERE order_ID = '$order_ID'";
    mysqli_query($con, $upd_total_price_query) or die(mysqli_error($con));
}

// Recalculate total price
$total_price = 0;
$sel_query = "SELECT * FROM order_product WHERE order_ID ='$order_ID';";
$result = mysqli_query($con, $sel_query) or die(mysqli_error($con));
while ($row = mysqli_fetch_assoc($result)) {
    $total_price += $row['unit_price'] * $row['quantity'];
}
// Update total price of the order
$upd_total_price_query = "UPDATE `order` SET total_price = '$total_price' WHERE order_ID = '$order_ID'";
mysqli_query($con, $upd_total_price_query) or die(mysqli_error($con));

// Redirect to product page
header("Location: product.php");
exit();
?>
