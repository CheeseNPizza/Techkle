<?php
    include("staff_auth.php");
    include("staff_header.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to Home Page</title>
        <link rel="stylesheet" href="css/staff_background.css">
    </head>
    <body>
        <div class="form">
            <?php
                if (isset($_COOKIE["staffEmail"])) {
                $cookie_value = $_COOKIE["staffEmail"];
                echo "Welcome, " . $cookie_value . ". Your cookie is now set.";
                } else {
                echo "Cookie is not set!";
                }
            ?>
            <p>This is secure area.</p><br>
            <p><a href="staff_dashboard.php">Staff Dashboard</a></p><br>
            <p><a href="staff_delete_cookie.php">Delete Cookie</a></p><br>
        </div>
    </body>
</html>