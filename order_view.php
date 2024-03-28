<?php
require("main_header.php");

$currencySymbol = "RM";
$total_price = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Update order</title>
</head>

<body>
    <h2>Order ID: <?php echo $_REQUEST['order_ID'] ?></h2>

    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Product ID</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Unit Price</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($_GET['order_ID'])) {
                $count = 1;
                $order_ID = $_GET['order_ID'];
                $sel_query = "SELECT * FROM order_product WHERE order_ID ='". $order_ID . "';";
                $result = mysqli_query($con, $sel_query) or die ( mysqli_error($con));

                while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td align="center"><?php echo $count; ?></td>
                        <td align="center"><?php echo $row['order_product_ID']; ?></td>
                        <td align="center"><?php echo $row['quantity']; ?></td>
                        <td align="center"><?php echo $currencySymbol . $row['unit_price']; ?></td>
                    </tr>
                <?php 
                    $count++;
                    $total_price += $row['unit_price'] * $row['quantity']; } }?>
        </tbody>
        <tfoot>
            <td colspan  = "3" align="right">Total Price:</td>
            <td colspan = "1" align="center"><?php echo $currencySymbol . number_format($total_price, 2); ?></td>
        </tfoot>
    </table>
    <hr>
    <a href = "order.php">Back to order</a>
</body>
</html>
