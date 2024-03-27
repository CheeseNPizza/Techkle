<?php
include("auth.php");
require('database.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main_header.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
<body>
    <div class="header">
        <img src="css/techkle_logo.png">
        
        <div class="title">
            <a href="order.php">
                <p>Cart<i class='bx bx-cart' ></i></p>    
            </a>
            <a href="login.php">     
                <p>Login<i class='bx bx-log-in'></i></p>
            </a>
        </div>
    </div>
</body>

</html>