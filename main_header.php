<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/main_header.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
<body>
    <div class="header">
        
            <div class="right">
                <a href="index.php"><img src="css/techkle_logo.png"></a>
                <?php 
                    if(!isset($_SESSION["customer_name"])){
                ?>
                <p>Welcome Guest!</p>
                <?php 
                    }else{
                ?>
                <p>Welcome <?php echo $_SESSION['customer_name']; ?>!</p>
                <?php 
                    }
                ?>
            </div>
        
        <div class="title">
            <a href="order.php">
                <p>Cart<i class='bx bx-cart' ></i></p>    
            </a>  
            <p id="loginBtn">Login<i class='bx bx-log-in'></i></p>
            
        </div>
    </div>
    <div class="popup">
        <!-- content -->
        <div class="child">
            <div class="wrapper">
                <p class="close">X</p>
                <h1>User Login</h1>
                <form action="login.php" method="post" name="login">
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
    <script>
        document.getElementById("loginBtn").addEventListener("click", function(){
            document.querySelector(".popup").style.display="flex";
        });

        document.querySelector(".close").addEventListener("click", function(){
            document.querySelector(".popup").style.display="none";
        });
    </script>
</body>
</html>