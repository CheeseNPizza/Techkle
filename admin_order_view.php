<?php
require("admin_header.php");
require('database.php');

$currencySymbol = "RM";
$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <title>Admin Update order</title>
</head>

<body>
    <div class = "container">
    <h2 class = "page-title">Admin Order Products Record</h2>
    <div class = "profile"><h2>Order ID: <?php echo $_REQUEST['order_ID'] ?></h2></div>

    <div class = "table">
    <div class = "table-header">
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead class = "tbl-header">
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Product ID</strong></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Product Image</strong></th>
                <th><strong>Product Description</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Unit Price</strong></th>
            </tr>
        </thead>
        </div>
        <tbody class = "tbl-content">
        <?php
            if(isset($_GET['order_ID'])) {
                $count = 1;
                $order_ID = $_GET['order_ID'];
                $sel_query = "SELECT * FROM order_product WHERE order_ID ='". $order_ID . "';";
                $result = mysqli_query($con, $sel_query) or die ( mysqli_error($con));

                while($row = mysqli_fetch_assoc($result)) {

                    $product_query = "SELECT * FROM product WHERE id = " . $row['product_ID'] . ";";
                    $product_result = mysqli_query($con, $product_query);
                    $product_row = mysqli_fetch_assoc($product_result);
                ?>
                    <tr>
                        <td align="center"><?php echo $count; ?></td>
                        <td align="center"><?php echo $row['product_ID']; ?></td>
                        <td align="center"><?php echo $product_row['product_name']; ?></td>
                        <td align="center"><img width="100" height="100" src="product_image/<?php echo $product_row['product_image']; ?>"/></td>
                        <td align="center"><?php echo $product_row['product_desc']; ?></td>
                        <td align="center"><?php echo $row['quantity']; ?></td>
                        <td align="center"><?php echo $currencySymbol . $row['unit_price']; ?></td>
                    </tr>
                <?php 
                    $count++;
                    $total_price += $row['unit_price'] * $row['quantity']; } }?>
        </tbody>
        <tfoot>
            <td colspan  = "6" align="right">Total Price:</td>
            <td colspan = "1" align="center"><?php echo $currencySymbol . number_format($total_price, 2); ?></td>
        </tfoot>
    </table>
    </div>
    </div>
    <br><hr><br>
    <a class = "table-btn" href = "admin_order.php">Back to order</a>
    </div>
</body>
</html>
