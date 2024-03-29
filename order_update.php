<?php
require("main_header.php");
require('database.php');

$currencySymbol = "RM";
$total_price = 0;
$status = "";

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $order_ID = $_REQUEST['order_ID'];
    $product_ID = $_REQUEST['product_ID'];
    $quantity = $_REQUEST['quantity'];


    $product_query = "SELECT * FROM product WHERE id = $product_ID";
    $product_result = mysqli_query($con, $product_query) or die(mysqli_error($con));
    $product_row = mysqli_fetch_assoc($product_result);
    if ($product_row != NULL) {

        $check_query = "SELECT * FROM order_product WHERE order_ID = $order_ID AND product_ID = $product_ID;";
        $check_result = mysqli_query($con, $check_query) or die(mysqli_error($con));
        $check_row = mysqli_fetch_assoc($check_result);

        $unit_price = $product_row['product_price'];

        //Check if the order product is already exist
        if ($check_row != NULL) {
            $new_quantity = $quantity + $check_row['quantity'];

            $upd_query="UPDATE order_product SET quantity = '".$new_quantity."' WHERE order_product_ID='".$check_row['order_product_ID']."';";
            mysqli_query($con, $upd_query) or die(mysqli_error($con));
            $status = "Product Record Updated Successfully.";

        } else {
            $ins_query="INSERT into order_product (`order_ID`,`product_ID`,`quantity`,`unit_price`)
                    VALUES ('$order_ID','$product_ID','$quantity','$unit_price')";
            mysqli_query($con,$ins_query) or die(mysqli_error($con));
            $status = "Product Record Inserted Successfully.";
        }

    } else {
        $status = "Product with the ID $product_ID does not exist.";
    }
}

if (isset($_POST['Update'])) {
    $order_product_ID = $_POST['order_product_ID'];
    $quantity = $_POST['quantity'];

    $upd_query="UPDATE order_product SET quantity = '".$quantity."' WHERE order_product_ID='".$order_product_ID."';";
    mysqli_query($con, $upd_query) or die(mysqli_error($con));
    $status = "Product Record Updated Successfully.";
}

if (isset($_POST['Delete'])) {
    $order_product_ID = $_POST['order_product_ID'];

    $del_query = "DELETE FROM `order_product` WHERE order_product_ID = $order_product_ID";
    $result = mysqli_query($con, $del_query) or die(mysqli_error($con));
    $status = "Product Record Deleted Successfully.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <title>Update order</title>
</head>

<body>
    <div class = "container">
    <div class = "profile"><h2>Order ID: <?php echo $_REQUEST['order_ID'] ?></h2></div>

    <p> <?php echo $status; ?> </p>

    <div class = "table">
    <div class = "table-header">
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Product ID</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Unit Price</strong></th>
                <th></th>
            </tr>
        </thead>
        <tbody class = "tbl-content">
        <?php
            if(isset($_GET['order_ID'])) {
                $count = 1;
                $total_price = 0;
                $order_ID = $_GET['order_ID'];
                $sel_query = "SELECT * FROM order_product WHERE order_ID ='". $order_ID . "';";
                $result = mysqli_query($con, $sel_query) or die ( mysqli_error($con));

                while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <form name="form" method="post" action="">
                        <td align="center"><?php echo $count; ?></td>
                        <td align="center"><?php echo $row['product_ID']; ?></td>
                        <td align="center"><input type = "number" name = "quantity" placeholder = "Update Quantity" required value = "<?php echo $row['quantity'];?>"></td>
                        <td align="center"><?php echo $currencySymbol . $row['unit_price']; ?></td>
                        <td align="center">
                        <input type="hidden" name="order_product_ID" value="<?php echo $row['order_product_ID']; ?>">
                        <input class = "table-btn" type="submit" name="Update" value="Update">
                        <input class = "table-btn" type="submit" name="Delete" value="Delete"
                            onclick="return confirm('Are you sure you want to delete this product?')">
                        </form>
                        </td>
                    </tr>
                <?php 
                    $count++;
                    $total_price += $row['unit_price'] * $row['quantity'];

                    $upd_total_price_query = "UPDATE `order` SET total_price = '$total_price' WHERE order_ID = '$order_ID'";
                    mysqli_query($con, $upd_total_price_query) or die(mysqli_error($con)); } }?>
        </tbody>
        <tfoot>
            <td colspan  = "3" align="right">Total Price:</td>
            <td colspan = "1" align="center"><?php echo $currencySymbol . number_format($total_price, 2); ?></td>
        </tfoot>
    </table>

    <?php
        $display_style = "none"; // Initial display style
        if (isset($_POST['toggle'])) {
            // Toggle the display style
            $display_style = ($_POST['toggle'] == 'hide') ? 'none' : 'block';
        }
    ?>
    </div>
    </div>
    <p><strong>Insert new product</strong></p>
    <form method="post">
        <button class = "table-btn" type="submit" name="toggle" value="<?php echo ($display_style == 'block') ? 'hide' : 'show'; ?>">
            <?php echo ($display_style == 'block') ? 'Hide' : 'Show'; ?>: Insert new product
        </button>
    </form>
    <div id="myDIV" style="display: <?php echo $display_style; ?>">
        <form name ="form" method="post" action="">
            <input type = "hidden" name = "new" value = "1"/>
            <p>Product ID: <input type="text" name="product_ID" placeholder="Enter product ID" required/></p>
            <p>Quantity: <input type="text" name="quantity" placeholder="Enter quantity" required/></p>
            <p><input class = "table-btn" name="submit" type="submit" value="Submit" />
                <input class = "table-btn" name="reset" type="reset" value="Reset" /></p>
        </form>
    </div>
    <br><hr><br>
    <a class ="table-btn" href = "order.php">Back to order</a>
</body>
<?php require("footer.php"); ?>
</html>