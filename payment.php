<?php
include("main_header.php");
require('database.php');
$customer_ID = $_SESSION['customer_ID'];
$total_price = 0;
$currencySymbol = "RM";
$order_ID = $_GET['order_ID'];

// Calculate total price based on order details
if(isset($_GET['order_ID'])) {
    $order_ID = $_GET['order_ID'];
    $sel_query = "SELECT * FROM order_product op, `order` o WHERE op.order_ID = o.order_ID AND o.order_ID ='". $order_ID . "';";
    $result = mysqli_query($con, $sel_query) or die ( mysqli_error($con));

    while($row = mysqli_fetch_assoc($result)) {
        $total_price += $row['unit_price'] * $row['quantity'];
    }
}

if(isset($_POST['new']) && $_POST['new']==1)
{
//update customer table
//combine address fields
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$country = $_POST['country'];

$address = $street . " " . $zip . " " . $city . ", " . $state . ", "  . $country;

$phone =$_REQUEST['phone'];
$update1="UPDATE customer SET `phone_number`='".$phone."',
address='".$address."'  WHERE customer_ID='".$customer_ID."'";
mysqli_query($con, $update1) or die(mysqli_error($con));

// Set cookies for address fields
setcookie('user_street', $street, time() + (86400 * 30), "/"); // 30 days expiry
setcookie('user_city', $city, time() + (86400 * 30), "/"); // 30 days expiry
setcookie('user_state', $state, time() + (86400 * 30), "/"); // 30 days expiry
setcookie('user_zip', $zip, time() + (86400 * 30), "/"); // 30 days expiry
setcookie('user_country', $country, time() + (86400 * 30), "/"); // 30 days expiry

// Set cookies for phone number
setcookie('user_phone', $phone, time() + (86400 * 30), "/"); // Phone number cookie expires in 30 days

//insert payment table
//$order_ID = $_REQUEST['order_ID'];
$payment_date = date("Y-m-d H:i:s");
$payment_method = $_REQUEST['paymentmethod'];
$amount = $total_price;
$payment_status = "Successful";
$insertQuery = "INSERT INTO payment (`order_ID`, `payment_date`, `payment_method`, `amount`, `payment_status`) 
VALUES ('$order_ID', '$payment_date', '$payment_method', '$amount', '$payment_status')";
 if (!mysqli_query($con, $insertQuery)) {
 die("Error: " . mysqli_error($con));
 
 } 

//update order status
$order_status = "Paid";
$update2="UPDATE `order` SET `status`='".$order_status."' WHERE order_ID ='".$order_ID."'";
mysqli_query($con, $update2) or die(mysqli_error($con));

header("Location: payment_success.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment</title>
    <link rel="stylesheet" href="css/paymenttest.css">
    <link rel="stylesheet" href="css/address_input.css">
    
    
</head>
<body>
    <h1 align="center">Checkout for order ID: <?php echo $order_ID?></h1>
    <div class="button-link">
    <a href='order.php'>Back to Order</a>
</div>
    
    <div class="order_detail_title">
        <h2>Order Summary</h2>
    </div>
    <div class="table_container">
        
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead class="tbl-header">
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Order Date & Time</strong></th>
                <th><strong>Product ID</strong></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Product Image</strong></th>
                <th><strong>Quantity</strong></th>             
                <th><strong>Unit Price</strong></th>
            </tr>
        </thead>
        <tbody class="tbl-content">
        <?php
            if(isset($_GET['order_ID'])) {
                $count = 1;
                $order_ID = $_GET['order_ID'];
                $sel_query = "SELECT * FROM order_product op, `order` o WHERE op.order_ID = o.order_ID AND o.order_ID ='". $order_ID . "';";
                $result = mysqli_query($con, $sel_query) or die ( mysqli_error($con));

                while($row = mysqli_fetch_assoc($result)) {
                    $product_query = "SELECT * FROM product WHERE id = " . $row['product_ID'] . ";";
                    $product_result = mysqli_query($con, $product_query);
                    $product_row = mysqli_fetch_assoc($product_result);
                ?>
                    <tr>
                        <td align="center"><?php echo $count; ?></td>
                        <td align="center"><?php echo $row['created_at']; ?></td>
                        <td align="center"><?php echo $row['product_ID']; ?></td>
                        <td align="center"><?php echo $product_row['product_name']; ?></td>
                        <td align="center"><img width="100" height="100" src="product_image/<?php echo $product_row['product_image']; ?>"/></td>
                        <td align="center"><?php echo $row['quantity']; ?></td>                          
                        <td align="center"><?php echo $currencySymbol . $row['unit_price']; ?></td>
                    </tr>
                <?php 
                    $count++;
                    //$total_price += $row['unit_price'] * $row['quantity']; 
                    } }?>
                
        </tbody>
        <tfoot>
            <td colspan  = "6" align="right" class="tf">Total Price:</td>
            <td colspan = "1" align="center"><?php echo $currencySymbol . number_format($total_price, 2); ?></td>
        </tfoot>
    </table>
    </div>
    <div class="form">
 <h2>Billing Information</h2>
 <div class="form-container">
 <form name="form" action="" method="post">
    <input type="hidden" name="new" value="1" />
    <label for="street">Street Address:</label>
    <input type="text" id="street" name="street" placeholder="Street Address" value="<?php echo isset($_COOKIE['user_street']) ? $_COOKIE['user_street'] : ''; ?>" required>

    <div class="city-state">
        <div class="city">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" placeholder="City" value="<?php echo isset($_COOKIE['user_city']) ? $_COOKIE['user_city'] : ''; ?>" required>
        </div>
        
        <div class="state">
            <label for="state">State:</label>
            <input type="text" id="state" name="state" placeholder="State" value="<?php echo isset($_COOKIE['user_state']) ? $_COOKIE['user_state'] : ''; ?>" required>
        </div>
    </div>

    <div class="zip-country">
        <div class="zip">
            <label for="zip">Zip Code:</label>
            <input type="text" id="zip" name="zip" placeholder="Zip Code" value="<?php echo isset($_COOKIE['user_zip']) ? $_COOKIE['user_zip'] : ''; ?>" required>
        </div>
        <div class="country">
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" placeholder="Country" value="<?php echo isset($_COOKIE['user_country']) ? $_COOKIE['user_country'] : ''; ?>" required>
        </div>
    </div>

    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" placeholder="XXX-XXX XXXX" pattern="\d{3}-\d{3} \d{4}" 
           title="XXX-XXX XXXX  E.g. 012-345 6789" value="<?php echo isset($_COOKIE['user_phone']) ? $_COOKIE['user_phone'] : ''; ?>" required>

    <label for="paymentmethod">Payment Method:</label>
    <select id="paymentmethod" name="paymentmethod" required>
        <option value="">Select Payment Method</option>
        <option value="credit_card">Credit Card</option>
        <option value="touchngo">Touch N Go</option>
        <option value="bank_transfer">Bank Transfer</option>
    </select>

    <input name="submit" type="submit" value="Make Payment">
</form>

    </div>
    <br>
 <br>
 <br>
 </div>
 <?php require('footer.php');?>
</body>
</html>