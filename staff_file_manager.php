<?php

include("staff_auth.php");
include("staff_header.php");
require('staff_database.php');

$staffEmail = isset($_SESSION['staffEmail']) ? $_SESSION['staffEmail'] : '';

    
    // Handle file upload or reupload
if (isset($_POST['upload'])) {
    if (isset($_FILES['file'])) {
        if (isset($_SESSION['staffEmail'])) {
            $uploadedFileName = $_FILES['file']['name'];
            $fileExtension = strtolower(pathinfo($uploadedFileName, PATHINFO_EXTENSION));
            $fileSize = $_FILES['file']['size'];

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Allowed image file extensions
            $maxFileSize = 20 * 1024 * 1024; // 20MB in bytes

            if (in_array($fileExtension, $allowedExtensions) && $fileSize < $maxFileSize) {
                // Check if file type is allowed and file size is within limit
                $targetDirectory = "staffProfile/";
                $targetFilePath = $targetDirectory . $uploadedFileName;

                // Check if the user's email already exists in the profile_image table
                $existingProfileImageQuery = "SELECT * FROM profile_image WHERE staffEmail = '$staffEmail'";
                $existingProfileImageResult = mysqli_query($con, $existingProfileImageQuery);

                if (mysqli_num_rows($existingProfileImageResult) > 0) {
                    // If the user's email exists, update the existing record
                    $existingProfileImageRow = mysqli_fetch_assoc($existingProfileImageResult);
                    $existingProfileImageId = $existingProfileImageRow['id'];

                    // Delete the old file
                    $oldFilename = $existingProfileImageRow['filename'];
                    $oldFilePath = "staffProfile/" . $oldFilename;
                    if (file_exists($oldFilePath) && !is_dir($oldFilePath)) {
                        unlink($oldFilePath);
                    }

                    // Update the record with the new file name
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                    $updateQuery = "UPDATE profile_image SET filename = '$uploadedFileName' WHERE id = $existingProfileImageId";
                    mysqli_query($con, $updateQuery) or die(mysqli_error($con));
                    $status = "Profile image re-uploaded successfully.";
                    }
                } else {
                    // If the user's email does not exist, insert a new record
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                        $insertQuery = "INSERT INTO profile_image (filename, staffEmail) VALUES ('$uploadedFileName', '$staffEmail')";
                        mysqli_query($con, $insertQuery) or die(mysqli_error($con));
                        $status = "File uploaded successfully.";
                    } else {
                        $status = "File upload failed.";
                    }
                }
            } else {
                $status = "Invalid file type or file size exceeded. Allowed file types: jpg, jpeg, png, gif. Maximum file size: 20MB.";
            }
        } else {
            $status = "Staff email not found in session.";
        }
    } else {
        $status = "No file uploaded.";
    }
}

    // Handle file deletion
    if (isset($_GET['delete'])) {
        $fileId = $_GET['delete'];
        $selectQuery = "SELECT filename FROM profile_image WHERE id = $fileId";
        $result = mysqli_query($con, $selectQuery);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $filename = $row['filename'];
            $filePath = "staffProfile/" . $filename;

            if (file_exists($filePath) && !is_dir($filePath)) {
                unlink($filePath);
            }

            $deleteQuery = "DELETE FROM profile_image WHERE id = $fileId";
            mysqli_query($con, $deleteQuery);

            $status = "File deleted successfully.";
        }
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>File Manager</title>
    <link rel="stylesheet" href="css/staff_background.css">
</head>
<body>
    <h1>File Manager</h1>
    <p>Status: <?php echo isset($status) ? $status : ''; ?></p>
    <h2>Profile Image</h2>
    <?php
        // Display the user's profile image or the default image
        $profileImageQuery = "SELECT * FROM profile_image WHERE staffEmail = '$staffEmail'";
        $profileImageResult = mysqli_query($con, $profileImageQuery);

        if (mysqli_num_rows($profileImageResult) > 0) {
            $profileImageRow = mysqli_fetch_assoc($profileImageResult);
            $profileImageFilename = $profileImageRow['filename'];
            echo "<img src='staffProfile/$profileImageFilename' alt='Profile Image' style='width: 200px; height: auto;' /><br>";
            echo "<a href='staff_file_manager.php?delete={$profileImageRow['id']}' onclick=\"return confirm('Are you sure you want to delete your profile image?')\">Delete Profile Image</a>";
        } else {
            // Display default profile image
            echo "<img src='staffProfile/default_profile.png' alt='Default Profile Image' style='width: 200px; height: auto;' /><br>";
            echo "<p>No profile image uploaded yet. You can upload one using the form below.</p>";
        }
    ?>
    <h2>Upload Profile Image</h2>
    <form enctype="multipart/form-data" method="post" action="">
        <input type="file" name="file" accept="image/*" required /><br><br> <!-- Accept only image files -->
        <input type="submit" name="upload" value="Upload Profile Image" />
    </form>
</body>
</html>
