<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Staff Registration</title>
    <link rel="stylesheet" href="css/login.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!--to use boxicons icons-->
</head>
<body>
    <?php
        include("staff_header.php");
        require('staff_database.php');

        if (isset($_POST['submit'])){
            // Data validation
            $errors = array();

            // Validate staff name
            $staffName = trim($_POST['staffName']);
            if (!preg_match("/^[a-zA-Z ]*$/", $staffName)) {
                $errors[] = "Staff name should only consist of letters and spaces.";
            }

            // Validate staff email
            $staffEmail = trim($_POST['staffEmail']);
            if (!filter_var($staffEmail, FILTER_VALIDATE_EMAIL) || !strpos($staffEmail, '@techkle.com')) {
                $errors[] = "Email is not valid or doesn't belong to @techkle.com domain.";
            }

            // Check if email already exists in the staff table
            $existingEmailQuery = "SELECT * FROM staff WHERE staffEmail = '$staffEmail'";
            $existingEmailResult = mysqli_query($con, $existingEmailQuery);
            if (mysqli_num_rows($existingEmailResult) > 0) {
                $errors[] = "Email already exists. Please choose a different email address.";
            }

            // Validate password
            $password = trim($_POST['password']);
            if (strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters long.";
            }

            // If there are no errors, proceed with registration
            if (empty($errors)) {
                $staffName = mysqli_real_escape_string($con, $staffName);
                $staffEmail = mysqli_real_escape_string($con, $staffEmail);
                $password = mysqli_real_escape_string($con, $password);
                $staffRole = mysqli_real_escape_string($con, $_POST['staffRole']); // Get selected staff role
            
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $query = "INSERT INTO `staff` (staffName, staffEmail, password, staffRole)
                          VALUES ('$staffName', '$staffEmail', '$hashedPassword', '$staffRole')";
                $result = mysqli_query($con, $query);

                if($result){
                    echo "<div class='form'>
                    <h3>You are registered successfully.</h3>
                    <br/>Click here to <a href='staff_login.php'>Login</a></div>";
                } else {
                    echo "Registration failed. Please try again.";
                }
            } else {
                // Display errors to the user
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
            }
        }
    ?>
    <div class="container">
    <div class="child">
        <div class="wrapper">
            <h2>Staff Registration</h2>
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
            <form name="registration" action="" method="post">
                <div class="input-box">
                    <input type="text" name="staffName" placeholder="Staff Name" required /><br>
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="staffEmail" placeholder="Email" required /><br>
                    <i class='bx bx-mail-send'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required /><br>
                    <i class='bx bx-lock'></i>
                </div>
                <div class="input-box">
                    <select name="staffRole" required>
                        <option value="" disabled selected>Select Staff Role</option>
                        <option value="Staff Manager">Staff Manager</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Accounting">Accounting</option>
                        <option value="Public Relations">Public Relations</option>
                        <option value="Admin">Admin</option>
                    </select><br>
                </div>
                <div class="loginbtn"> <!-- Assuming 'loginbtn' is the class for the submit button -->
                    <input type="submit" name="submit" value="Register" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
