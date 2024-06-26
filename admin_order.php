<?php
    include("staff_header.php");
    require('database.php');

$currencySymbol = "RM";
$status = "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
    <title>Admin Orders History</title>
</head>

<body>
    <div class= "container">
        <h2 class = "page-title">Admin Order History</h2>
            <p> <?php echo $status; ?> </p>
        <div class = "table">
        <div class = "table-header">
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead class="tbl-header">
                <tr>
                    <th class = "header-cell"><strong>No</strong></th>
                    <th><strong>Order ID</strong></th>
                    <th><strong>Date and Time</strong></th>
                    <th><strong>Total Price</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong></strong></th>
                </tr>
            </thead>
        </div>
            <tbody class="tbl-content">
            <?php
                    $count=1;
                    $sel_query = "SELECT * FROM `order` ORDER BY order_ID DESC;";
                    $result = mysqli_query($con,$sel_query);
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td align="center"><?php echo $count; ?></td> 
                    <td align="center"><?php echo $row['order_ID']; ?></td>
                    <td align="center"><?php echo $row['created_at']; ?></td>
                    <td align="center"><?php echo $currencySymbol . $row['total_price']; ?></td>
                    <td align="center"><?php echo $row['status']; ?></td>
                    <td align="center">
                        <a class = "table-btn" href="admin_order_view.php?order_ID=<?php echo $row['order_ID']; ?>">View</a>
                        <a class = "table-btn" href="admin_order_update.php?order_ID=<?php echo $row['order_ID']; ?>">Update</a>
                        <a class = "table-btn" href="admin_order_delete.php?order_ID=<?php echo $row['order_ID']; ?>"
                            onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                </tr>
            <?php  $count++;}  ?>
            </tbody>
        </table>
        </div>
    </div>
    
</body>

</html>