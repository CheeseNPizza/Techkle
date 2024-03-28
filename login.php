<?php
    session_start();

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
            header("Location: product.php"); //navigate to main page
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

