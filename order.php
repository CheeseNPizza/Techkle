<?php
require("main_header.php");
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
    <title>Orders</title>
</head>

<body>
    <?php 
        if(!isset($_SESSION["customer_ID"])) { ?>
            <div class="popup">
        <!-- content -->
        <div class="child">
            <div class="wrapper">
                <p class="close">X</p>
                <h1>User Login</h1>
                <form action="login.php" method="post" name="login">
                    <div class="input-box">
                        <input type="text" name="customer_name" placeholder="Username" required /><br>
                        <i class='bx bx-user'></i>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required /><br>
                        <i class='bx bx-lock'></i>
                    </div>

                    <div class="forgot">
                        <label><input type="checkbox" name="remember_me" id="remember_me">Remember Me</label>
                    </div>

                    <div class="loginbtn">
                        <input name="submit" type="submit" value="Login" />
                    </div>
                    
                    <div class="register">
                        <p>Don't have an account? <a href="registration.php"> Register </a></p>
                    </div>
                    <div class="register">
                        <p>Login as a staff? <a href="staff_login.php"> Click here </a></p>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.querySelector(".popup").style.display="flex";
        </script>
    <?php } else { ?>
    <div class= "container">
        <h2 class = "page-title">Order History</h2>
        <div class = "profile">
            <p class = "profile-name">User ID: <?php echo $_SESSION['customer_ID']; ?> 
            <br>Username: <?php echo $_SESSION['customer_name']; ?></p>
        </div>

            <p><a class = "table-btn" href = "order_create.php">Create new order</a></p>
            <p> <?php echo $status; ?> </p>
        <div class = "table">
        <div class = "table-header">
        <table width="100%" border="1" style="border-collapse:collapse;">
            <thead class="tbl-header">
                <tr>
                    <th class = "header-cell"><strong>Order ID</strong></th>
                    <th><strong>Date and Time</strong></th>
                    <th><strong>Total Price</strong></th>
                    <th><strong>Status</strong></th>
                    <th><strong></strong></th>
                    <th></th>
                </tr>
            </thead>
        </div>
            <tbody class="tbl-content">
            <?php
                $sel_query = "SELECT * FROM `order` WHERE user_ID = '{$_SESSION['customer_ID']}' ORDER BY order_ID DESC;";
                $result = mysqli_query($con,$sel_query);
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td align="center"><?php echo $row['order_ID']; ?></td>
                    <td align="center"><?php echo $row['created_at']; ?></td>
                    <td align="center"><?php echo $currencySymbol . $row['total_price']; ?></td>
                    <td align="center"><?php echo $row['status']; ?></td>
                    <td align="center">
                        <a class = "table-btn" href="order_view.php?order_ID=<?php echo $row['order_ID']; ?>">View</a>
                    <?php if ($row['status'] == "Pending") { ?>
                        <a class = "table-btn" href="order_update.php?order_ID=<?php echo $row['order_ID']; ?>">Update</a>
                        <a class = "table-btn" href="order_delete.php?order_ID=<?php echo $row['order_ID']; ?>"
                            onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                    </td>
                    <td align="center">
                        <a class = "table-btn confirm" href="payment.php?order_ID=<?php echo $row['order_ID'];?>"
                            onclick="return confirm('Do you want to confirm the order?')">Confirm</a>
                    </td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                </tr>
            <?php } } }?>
            </tbody>
        </table>
        </div>
    </div>
    
</body>

</html>