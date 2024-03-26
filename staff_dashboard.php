<?php
    include("staff_auth.php");
    include("staff_header.php");
    require('staff_database.php');

    // Check if the logged-in staff is an admin
    $isAdmin = false;
    if ($_SESSION['staffRole'] == "Admin") {
        $isAdmin = true;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Secured Page</title>
    <link rel="stylesheet" href="css/staff_background.css">
</head>
<body>
    <div class="form">
        <p>Staff Dashboard</p>
        <p>Access Granted - This page is protected.</p>
        <?php if ($isAdmin): ?>
            <!-- Only display the link if the logged-in staff is an admin -->
            <p><a href='staff_registration.php'>Insert new staff</a></p>
        <?php endif; ?>
        <p><a href="staff_view.php">View your information</a></p>
        <p><a href="staff_display_profile.php">Company Staff</a></p>
    </div>
</body>
</html>
