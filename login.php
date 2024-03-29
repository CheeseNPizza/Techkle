<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
<body>

<div class="container">
    <div class="child">
        <div class="wrapper">
            <h2>User Login</h2>
            <?php
            session_start();
            require('database.php');

            // Initialize errors array
            $errors = array();

            if(isset($_POST['customer_name'])) {
                // Validate user inputs
                $customer_name = trim($_POST['customer_name']);
                $password = trim($_POST['password']);

                // Data Validation
                if (!preg_match("/^[a-zA-Z ]+$/", $customer_name)) {
                    $errors[] = "Customer name should only consist of letters and spaces.";
                }

                if (strlen($password) < 6) {
                    $errors[] = "Password must be at least 6 characters long.";
                }

                // If there are no errors, proceed with authentication
                if (empty($errors)) {
                    $customer_name = mysqli_real_escape_string($con, $customer_name);
                    $password = mysqli_real_escape_string($con, $password);

                    $query = "SELECT *
                        FROM `customer`
                        WHERE customer_name='$customer_name'
                        AND password='".md5($password)."'";

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
                        $errors[] = "Username/password is incorrect.";
                    }
                }

                // Display errors
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p class='error'>$error</p>";
                    }
                }
            }
            ?>
            <form name="login" action="" method="post">
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
