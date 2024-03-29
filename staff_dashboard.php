<?php
    include("staff_auth.php");
    include("staff_header.php");
    require('staff_database.php');

    // Check if the logged-in staff is an admin
    $isAdmin = false;
    if ($_SESSION['staffRole'] == "Admin") {
        $isAdmin = true;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Staff Dashboard - Secured Page</title>
    <link rel="stylesheet" href="css/staff_background.css">
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
            height: 100vh; /* Full viewport height */
            padding: 0 20px;
        }

        .form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 600px; /* Max width of the form */
            background-color: #fff;
            border: 2px solid #005691;
            border-radius: 25px;
            padding: 50px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        .form p {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px; /* Increase bottom margin */
        }

        .content {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px; /* Max width of the content */
        }

        .content a {
            text-decoration: none;
            color: #005691;
            border: 2px solid #005691;
            border-radius: 20px;
            padding: 10px 20px;
            margin-bottom: 20px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        .content a:hover {
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
                <?php if ($isAdmin): ?>
                <!-- Only display the link if the logged-in staff is an admin -->
                <a href='staff_registration.php'>Insert new staff</a>
                <a href="product_record.php">Product record</a>
                <a href="admin_order.php">Order</a>
                <?php endif; ?>
                <a href="staff_view.php">View your information</a>
                <a href="staff_display_profile.php">Company Staff</a>
            </div>
        </div>
    </div>
</body>
</html>
