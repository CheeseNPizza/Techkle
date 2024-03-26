<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset='utf-8'>
    <title>User Login Form</title>
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
<body>
    <?php
    require('database.php');

    if(isset($_POST['customer_name']))
    {
        //validate users
        $customer_name = stripslashes($_REQUEST['customer_name']);
        $customer_name = mysqli_real_escape_string($con,$customer_name);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);

        $query = "SELECT *
        FROM `customer`
        WHERE customer_name='$customer_name'
        AND password='".md5($password)."'"
        ;

        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);

        if ($rows == 1){
            $userData = mysqli_fetch_assoc($result);
            $_SESSION['customer_name'] = $customer_name;
            $_SESSION['customer_ID'] = $userData['customer_ID'];
            $_SESSION['last_timestamp'] = time();

            //set cookie
            if (isset($_POST['remember_me'])) {
                $cookie_name = "user";
                $cookie_value = $customer_name;
                $expiration_time = time() + 60 * 60 * 24 * 30;
                setcookie($cookie_name, $cookie_value, $expiration_time, "/");
            }
            header("Location: index.php"); //navigate to main page
            exit();
        }
        else {
            echo "<div class='form'>
            <h3>Username/password is incorrect.</h3>
            <br/>Click here to <a href='login.php'>Login</a></div>";
        }

        if (isset($_GET['session_expired']) && $_GET['session_expired'] == 1) {
            echo "<script>alert('Your session has expired. Please log in again.');</script>";
            session_destroy();
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
                    <h1>User Login</h1>

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
        
    </div>
    

</body>
</html>
