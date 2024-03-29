<?php
    // session_start();
    require("admin_header.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Staff Login</title>
        <link rel="stylesheet" href="css/login.css">
        <!-- <link rel="stylesheet" type="text/css" href="css/admin_header.css"> -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
    </head>
    <body>
    <?php
        require('staff_database.php');

        $errors = []; // Initialize an empty array for errors

        if (isset($_POST['staffEmail']) && isset($_POST['password'])) {
            $staffEmail = mysqli_real_escape_string($con, $_POST['staffEmail']);
            $password = mysqli_real_escape_string($con, $_POST['password']);

            // Data Validation
            if (!filter_var($staffEmail, FILTER_VALIDATE_EMAIL) || !strpos($staffEmail, '@techkle.com')) {
                $errors[] = "Email is not valid or doesn't belong to @techkle.com domain.";
            }

            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }

            // If there are no errors, proceed with login attempt
            if (empty($errors)) {
                $query = "SELECT * FROM `staff` WHERE staffEmail='$staffEmail'";
                $result = mysqli_query($con, $query);

                if ($result && mysqli_num_rows($result) == 1) {
                    $staffData = mysqli_fetch_assoc($result);
                    if (password_verify($password, $staffData['password'])) {
                        $_SESSION['staffName'] = $staffData['staffName'];
                        $_SESSION['staffEmail'] = $staffEmail;
                        $_SESSION['staff_id'] = $staffData['id'];
                        $_SESSION['staffRole'] = $staffData['staffRole']; 
                        $_SESSION['last_timestamp'] = time();

                        if (isset($_POST['remember_me'])) {
                            $cookie_name = "staffEmail";
                            $cookie_value = $staffEmail;
                            $expiration_time = time() + 60 * 60 * 24 * 30;
                            setcookie($cookie_name, $cookie_value, $expiration_time, "/");
                        }
                        header("Location: staff_index.php");
                        exit();
                    } else {
                        $errors[] = "Password is incorrect.";
                    }
                } else {
                    $errors[] = "Staff not found.";
                }
            }
        } elseif (isset($_GET['session_expired']) && $_GET['session_expired'] == 1) {
            echo "<script>alert('Your session has expired. Please log in again.');</script>";
            session_destroy();
        }
    ?>
        <div class="child">
            <div class="wrapper">
                <h1>Staff Log In</h1>
                <?php 
                    // Display errors if any
                    if (!empty($errors)) {
                        echo "<div class='errors'>";
                        foreach ($errors as $error) {
                            echo "<p>Error: $error</p>";
                        }
                        echo "</div>";
                    }
                ?>
                <form action="" method="post" name="login">
                    <div class="input-box">
                        <input type="email" name="staffEmail" placeholder="Staff Email" required />
                        <i class='bx bx-mail-send'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" required />
                        <i class='bx bx-lock'></i>
                    </div>
                    <div class="forgot">
                        <input type="checkbox" name="remember_me" id="remember_me">
                        <label for="remember_me">Remember Me</label>
                    </div>
                    <div class="loginbtn">
                        <input name="submit" type="submit" value="Login" />
                    </div>
                    <div class="register">
                            <p>Login as a customer? <a href="login.php"> Click here </a></p>
                    </div>
                </form>
            </div>
        </div>
</div>

    </body>
</html>
