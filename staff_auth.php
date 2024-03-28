<?php
    session_start();
    $timeout_duration = 3600;

    if(!isset($_SESSION['staffName'])|| (time() - $_SESSION['last_timestamp'])> $timeout_duration){
        session_unset();
        session_destroy();
        header("Location: staff_login.php?session_expired=1");
        exit(); 
    }else{
        session_regenerate_id(true);

        $_SESSION['last_timestamp'] = time();
    }
?>