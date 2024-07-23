<?php 


session_abort();
session_start();

if(isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_role']);
    unset($_SESSION['user_first_name']);
    unset($_SESSION['user_last_name']);
    unset($_SESSION['username']);
    unset($_SESSION['user_image']);
    unset($_SESSION['user_email']);
    $_SESSION['success'] = "Your logged out now!";
    header("location: ../../index.php");
    exit();
    
} else {
    header("location: ../../index.php");
}
