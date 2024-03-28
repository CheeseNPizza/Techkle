<?php
    include("staff_auth.php");
    include("staff_header.php");
    require('staff_database.php');

    // Fetch all profile images along with staff information
    $query = "SELECT s.staffName, s.staffEmail, s.staffRole, COALESCE(pi.filename, 'default_profile.png') AS filename 
              FROM staff s 
              LEFT JOIN profile_image pi ON s.staffEmail = pi.staffEmail";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Company Members</title>
    <link rel="stylesheet" href="css/staff_background.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .member {
            margin: 20px;
            text-align: center;
        }
        .member img {
            width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Company Members</h1>
    <div class="container">
        <?php $count = 0; ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="member">
                <img src="staffProfile/<?php echo $row['filename']; ?>" alt="Profile Image">
                <p>Name: <?php echo $row['staffName']; ?></p>
                <p>Email: <?php echo $row['staffEmail']; ?></p>
                <p>Role: <?php echo $row['staffRole']; ?></p>
            </div>
            <?php $count++; ?>
            <?php if ($count % 3 == 0): ?>
                </div><div class="container">
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</body>
</html>
