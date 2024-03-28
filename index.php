<?php
require("main_header.php");

if(isset($_COOKIE["user"])) {
    $cookie_value = $_COOKIE["user"];
    echo "Welcome, " . $cookie_value . ". Your cookie is now set.";
} else {
    echo "Cookie is not set!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Home Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background-color: #f2f2f2;
        }

        .form {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form">
        <p>Welcome <?php echo $_SESSION['customer_name']; ?>!</p>
        <p>This is secure area.</p><br>
        <p><a href="dashboard.php">User Dashboard</a></p><br>
        <p><a href="delete_cookie.php">Delete Cookie</a></p><br>
    </div>

</body>
</html>