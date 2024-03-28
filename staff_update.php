<?php
    include("staff_auth.php");
    include("staff_header.php");
    require('staff_database.php');

    $id = $_REQUEST['id'];
    $query = "SELECT * FROM staff WHERE id='$id'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    // Check if form is submitted
    if(isset($_POST['submit'])) {
        // Retrieve form data
        $id = $_REQUEST['id'];
        $staffName = mysqli_real_escape_string($con, $_REQUEST['staffName']);
        $staffEmail = mysqli_real_escape_string($con, $_REQUEST['staffEmail']);
        $staffRole = mysqli_real_escape_string($con, $_REQUEST['staffRole']);
        $hashpassword = ''; // Initialize an empty string for the hashed password

        // Data validation
        $errors = array();

        // Validate staffName
        if (empty($staffName)) {
            $errors[] = "Staff Name is required.";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $staffName)) {
            $errors[] = "Staff name should only consist of letters and spaces.";
        }

        // Validate staffEmail
        if (empty($staffEmail) || !filter_var($staffEmail, FILTER_VALIDATE_EMAIL) || !strpos($staffEmail, '@techkle.com')) {
            $errors[] = "Valid Staff Email is required.";
        }

        // If a new password is provided, hash it
        if (!empty($_POST['password'])) {
            $password = $_POST['password'];
            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            } else {
                $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            }
        }

        // If there are no errors, proceed with updating the record
        if (empty($errors)) {
            // Update the staff record in the database
            $update_query = "UPDATE staff SET staffName='$staffName', staffEmail='$staffEmail', staffRole='$staffRole'";
            // If a new password is provided, include it in the update query
            if (!empty($hashpassword)) {
                $update_query .= ", password='$hashpassword'";
            }
            $update_query .= " WHERE id='$id'";
            mysqli_query($con, $update_query) or die(mysqli_error($con));
            $status = "Staff Record Updated Successfully. </br></br>
            <a href='staff_view.php'>View Updated Record</a>";
            echo '<p style="color:#008000;">'.$status.'</p>';
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo '<p style="color: red;">'.$error.'</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Staff Record</title>
    <link rel="stylesheet" href="css/staff_background.css">
</head>
<body>
    <h1>Update Staff Record</h1>
    <?php if(!isset($status)) { ?>
    <form name="form" method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <p>
            <label for="staffName">Staff Name:</label>
            <input type="text" id="staffName" name="staffName" required value="<?php echo $row['staffName']; ?>" />
        </p>
        <p>
            <label for="staffEmail">Staff Email:</label>
            <input type="email" id="staffEmail" name="staffEmail" required value="<?php echo $row['staffEmail']; ?>" />
        </p>
        <p>
            <label for="staffRole">Staff Role:</label>
            <select id="staffRole" name="staffRole">
                <option value="Staff Manager" <?php if($row['staffRole']=="Staff Manager") echo "selected"; ?>>Staff Manager</option>
                <option value="Human Resources" <?php if($row['staffRole']=="Human Resources") echo "selected"; ?>>Human Resources</option>
                <option value="Accounting" <?php if($row['staffRole']=="Accounting") echo "selected"; ?>>Accounting</option>
                <option value="Public Relations" <?php if($row['staffRole']=="Public Relations") echo "selected"; ?>>Public Relations</option>
                <option value="Admin" <?php if($row['staffRole']=="Admin") echo "selected"; ?>>Admin</option>
            </select>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep current password" />
        </p>
        <p><button type="button" onclick="location.href='staff_file_manager.php'">Update Profile Picture</button></p>
        <p><input name="submit" type="submit" value="Update" /></p>
    </form>
    <?php } ?>
</body>
</html>
