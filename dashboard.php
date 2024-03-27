<?php
require("admin_header.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Dashboard - Secured Page</title>
    <style>
        * {
            margin:0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 110px;
        }

        .form {
            display: flex;
            flex-direction:column;
            justify-content: center;
            align-items: center;
            height:350px;  
            width: 550px;
            background-color: #fff;
            border: 2px solid #005691 ;
            border-radius:25px;    
            padding: 50px 10px 80px 10px;
            text-align: center;
        }

        .form p {
            font-size:24px;
            font-weight: bold;
            margin: 50px 0;
        }
        
        .content {
            display: flex;
            flex-direction: column;
        }
        
        .content a{
            text-decoration: none;
            color:#005691;
            border: 2px solid #005691;
            border-radius: 20px;
            padding: 10px 20px 10px 20px;
            margin-bottom: 20px;
            font-weight:bold;
        }

        .content a:hover{
            background-color: #005691;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <p>Access Granted - This page is protected.</p>
            <div class="content">
                <a href="product.php">Main page</a>
                <a href="product_record.php">Product record</a>
                <a href="order.php">Order</a>
            </div>
        </div>
    </div>
</body>
</html>