<?php
    include("staff_auth.php");
    include("staff_header.php");
    require('staff_database.php');

    // Check if the logged-in staff has admin role
    $isAdmin = ($_SESSION['staffRole'] == "Admin");
    $loggedInStaffEmail = $_SESSION['staffEmail']; // Assuming staff email is stored in session upon login
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Staff Records</title>
    <link rel="stylesheet" href="css/staff_background.css">
</head>
<body>
    <h2>View Staff Records</h2>
    <table width="100%" border="1" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th><strong>No.</strong></th>
                <th><strong>Staff Name</strong></th>
                <th><strong>Staff Email</strong></th>
                <th><strong>Staff Role</strong></th>
                <th><strong>Edit</strong></th>
                <?php if ($isAdmin): ?> <!-- Only display Delete column if user is admin -->
                    <th><strong>Delete</strong></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $count = 1;
                // Query to fetch staff records based on user role
                if ($isAdmin) {
                    $sel_query = "SELECT * FROM staff ORDER BY id DESC;";
                } else {
                    $sel_query = "SELECT * FROM staff WHERE staffEmail = '$loggedInStaffEmail' ORDER BY id DESC;";
                }
                $result = mysqli_query($con, $sel_query);
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td align="center"><?php echo $count; ?></td>
                <td align="center"><?php echo $row["staffName"]; ?></td>
                <td align="center"><?php echo $row["staffEmail"]; ?></td>
                <td align="center"><?php echo $row["staffRole"]; ?></td>
                <td align="center">
                    <?php if ($row["staffEmail"] == $loggedInStaffEmail): ?> <!-- Only display Update link if staff email matches logged-in staff's email -->
                        <a href="staff_update.php?id=<?php echo $row["id"]; ?>">Update</a>
                    <?php endif; ?>
                </td>
                <?php if ($isAdmin || $row["staffEmail"] != $loggedInStaffEmail): ?> <!-- Only display Delete link if user is admin or if it's not the logged-in staff -->
                    <td align="center">
                        <a href="staff_delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to delete this staff record?')">Delete</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php $count++; } ?>
        </tbody>
    </table>
</body>
</html>
