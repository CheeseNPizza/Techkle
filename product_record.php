<?php
require('database.php');
include("staff_header.php");
include("staff_auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Product Records</title>
    <link rel="stylesheet" href="css/product_record.css">
</head>
<body>
    <?php
        if(isset($_GET['status']) && $_GET['status'] == 'success') {
            echo "<script>alert('New product inserted successfully.');</script>";
        }
        if(isset($_GET['update']) && $_GET['update'] == 'success') {
            echo "<script>alert('Product updated successfully.');</script>";
        }
    ?>
    <div class="product_record_title">
        <h2>View Product Records</h2>
        <p><a href = "product_create.php">Create new product</a></p>
        <p><a href = "product.php">View product page</a></p>
    </div>
    <div class="table_container">
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead>
                <tr>
                <th><strong>No.</strong></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Product Description</strong></th>
                <th><strong>Product Price</strong></th>
                <th><strong>Product Category</strong></th>
                <th><strong>Product Quantity</strong></th>
                <th><strong>Product Image</strong></th>
                <th><strong>Date and Time Recorded</strong></th>
                <th><strong>Edit</strong></th>
                <th><strong>Delete</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                $sel_query="SELECT * FROM product ORDER BY id desc;";
                $result = mysqli_query($con,$sel_query);
                $currencySymbol = "RM";
                while($row = mysqli_fetch_assoc($result)) { 
                ?>
                <tr><td align="center"><?php echo $count; ?></td> 
                <td align="center"><?php echo $row["product_name"]; ?></td>
                <td align="center"><?php echo $row["product_desc"]; ?></td>
                <td align="center"><?php echo $currencySymbol . $row["product_price"]; ?></td>
                <td align="center"><?php echo $row["product_cat"]; ?></td>
                <td align="center"><?php echo $row["product_quantity"]; ?></td>
                <td align="center" class="product-image-cell"><img src="product_image/<?php echo $row["product_image"]; ?>"/></td>
                <td align="center"><?php echo $row["product_reg_date"]; ?></td>
                <td align="center">
                <a href="product_update.php?id=<?php echo $row["id"]; ?>">Update</a> <!--get the responding id of the line-->
                </td>
                <td align="center">
                <a href="product_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this product record?')">Delete</a>
                </td>
                </tr>
                <!-- end of our form handling, increment -->
                <?php $count++; } ?>
            </tbody>
        </table>
    </div>
</body>
</html>