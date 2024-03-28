<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>User registration</title>
<link rel="stylesheet" href="css/registration.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>

<body>
<?php
require("database.php");

if (isset($_REQUEST['customer_name'])){
    $customer_name = stripslashes($_REQUEST['customer_name']);
    $customer_name = mysqli_real_escape_string($con, $customer_name);
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($con, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);
    $reg_date = date("Y-m-d H:i:s");

    $query = "INSERT into `customer` (customer_name, password, email, reg_date) VALUES ('$customer_name', '".md5($password)."', '$email', '$reg_date')";
    $result = mysqli_query($con, $query);
    if ($result){
        echo "<div class='form'>
        <h3>You are registered successfully.</h3>
        <br>Click here to <a href='login.php'>Login</a></div>";
    }
}
?>

<div class="container">
    <div class="header">
        account name
    </div>
    <div class="child">
        <div class="wrapper">
            <form action="" method="post" name="login">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type = "text" name="customer_name" placeholder="Username" required/><br>
                    <i class='bx bx-user'></i>
                </div>

                <div class="input-box">
                    <input type = "email" name="email" placeholder="Email" required/><br>
                    <i class='bx bx-envelope'></i>
                </div>

                <div class="input-box">
                    <input type = "password" name="password" placeholder="Password" required/><br>
                    <i class='bx bx-lock'></i>
                </div>

                <div class="registerbtn">
                    <input type="submit" name="submit" value="Submit">
                </div>

                <div class="register">
                    <p>Cancel operation? <a href="product.php">Click here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>