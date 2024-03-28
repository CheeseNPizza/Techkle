<?php
    require('staff_database.php');

    // Get staff ID from the query string
    $id = $_GET['id'];

    // Construct the SQL DELETE query
    $query = "DELETE FROM staff WHERE id=$id";

    // Execute the query
    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    // Redirect to the view.php page
    header("Location: staff_view.php");
    exit();
?>
