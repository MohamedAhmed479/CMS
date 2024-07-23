<?php

session_start();
require_once "../includes/db.php";

if(isset($_POST['login_submit'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

        // validation
        $errors = [];

        if (empty($username)) {
            $errors[] = "username is required.";
        }
    
        if (empty($password)) {
            $errors[] = "password is required.";
        }
        
        if(empty($errors)) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) == 1) {
                $user_info = mysqli_fetch_assoc($runQuery);
                $old_password_hashed = $user_info['password'];
                $user_id = $user_info['id'];
                $user_role = $user_info['role'];
                $user_first_name = $user_info['first_name'];
                $user_last_name = $user_info['last_name'];
                $db_username = $user_info['username'];
                $user_image = $user_info['image'];
                $user_email = $user_info['email'];

                if(password_verify($password, $old_password_hashed)) {
                    // success login 
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_role'] = $user_role;
                    $_SESSION['user_first_name'] = $user_first_name;
                    $_SESSION['user_last_name'] = $user_last_name;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['user_image'] = $user_image;
                    $_SESSION['user_email'] = $user_email;
                    
                    if($_SESSION['user_role'] == "admin") {
                        header("location: ../admin/index.php");
                    } else {
                        $success_msg = "Welcome to Back, $user_first_name $user_last_name!";
                        $_SESSION['success'] = $success_msg;
                        header("location: ../index.php");
                    }

                } else {
                    $_SESSION['errors'] = ['Incorrect Information. Please try again.'];
                    header("location: ../index.php");
                }

            } else {
                $_SESSION['errors'] = ['Incorrect Information. Please try again.'];
                header("location: ../index.php");
            }
            
        } else {
            $_SESSION['errors'] = $errors;
            header("location: ../index.php");
        }




} else {
    header("location: ../index.php");
}