<?php
    $cookie_name = "staffEmail";
    if (isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, "", time() - 3600, "/");
        echo "<h3>Cookie deleted. Click here to <a href='staff_logout.php'>Logout</a></h3>";
    } else {
        echo "<h3>Cookie not found. Click here to <a href='staff_logout.php'>Logout</a></h3>";
    }
?>