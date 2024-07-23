<?php

session_start();
require "../../includes/db.php";

if(isset($_POST['change_to_admin']) && is_numeric($_POST['user_id'])) {
    // change user role from subscriber to admin 
    $new_role = "admin";

} elseif(isset($_POST['change_to_subscriber']) && is_numeric($_POST['user_id'])) {
    // change user role from admin to subscriber 
    $new_role = "subscriber";

} else {
    header("location: ../users.php");
    exit();
}

$user_id = $_POST['user_id'];




$query = "SELECT role FROM users WHERE id = $user_id";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) != 1) {
    $_SESSION['errors'] = ['This User Is not Falid'];
    header("location: ../users.php");
    exit();
}

// user is exist
$old_role = mysqli_fetch_assoc($runQuery)['role'];

if($old_role == $new_role) {
    $error = "This user Is Alredy $new_role";
    $_SESSION['errors'] = [$error];
    header("location: ../users.php");
    exit();
}


$query = "UPDATE users SET role = '$new_role'
            WHERE id = $user_id";
$runQuery = mysqli_query($conn, $query);
if($runQuery) {
    if($_SESSION['user_id'] == $user_id) {
        require_once "handle.logout.php";
    }
    if($new_role == "admin") {
        $success_msg = "You have just converted this user to an admin";
    } else {
        $success_msg = "You have just converted this user to a subscriber";
    }
    $_SESSION['success'] = $success_msg;
    header("location: ../users.php");
    exit();
}
