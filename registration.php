<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>User registration</title>
<link rel="stylesheet" href="css/registration.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>

<body>

<div class="container">
    <div class="header">
        account name
    </div>
    <div class="child">
        <div class="wrapper">
            <form action="" method="post" name="login">
                <h1>Registration</h1>
                <?php
                require("database.php");

                // Process form data
                $errors = array();
                if (isset($_POST['submit'])) {
                    $customer_name = stripslashes($_POST['customer_name']);
                    $customer_name = mysqli_real_escape_string($con, $customer_name);
                    $email = stripslashes($_POST['email']);
                    $email = mysqli_real_escape_string($con, $email);
                    $password = stripslashes($_POST['password']);
                    $password = mysqli_real_escape_string($con, $password);
                    $reg_date = date("Y-m-d H:i:s");

                    // Data Validation
                    // Validate email
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = "Invalid email format.";
                    }

                    // Validate name (only letters and spaces allowed)
                    if (!preg_match("/^[a-zA-Z ]+$/", $customer_name)) {
                        $errors[] = "Username should only consist of letters and spaces.";
                    }

                    // Validate password (at least 6 characters long)
                    if (strlen($password) < 6) {
                        $errors[] = "Password must be at least 6 characters long.";
                    }

                    // Check if email already exists
                    $query = "SELECT * FROM `customer` WHERE email='$email'";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0) {
                        $errors[] = "Email already exists. Please choose a different email address.";
                    }

                    // Check if username already existss
                    $query = "SELECT * FROM `customer` WHERE customer_name='$customer_name'";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0) {
                        $errors[] = "Username already exists. Please choose a different username.";
                    }

                    // If there are no errors, proceed with registration
                    if (empty($errors)) {
                        $query = "INSERT into `customer` (customer_name, password, email, reg_date) VALUES ('$customer_name', '".md5($password)."', '$email', '$reg_date')";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            echo "<div class='form'>
                            <h3>You are registered successfully.</h3>
                            <br>Click here to <a href='product.php'>Main Page</a></div>";
                        } else {
                            echo "Error: " . mysqli_error($con);
                        }
                    }
                }

                // Display validation errors
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<div class='form'>
                        <p>$error</p>
                        </div>";
                    }
                }
                ?>
                <div class="input-box">
                    <input type="text" name="customer_name" placeholder="Username" required/><br>
                    <i class='bx bx-user'></i>
                </div>

                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required/><br>
                    <i class='bx bx-envelope'></i>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required/><br>
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
