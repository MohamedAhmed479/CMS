<?php
session_start();
require_once "../../includes/db.php";





if(isset($_POST['submit_add_user'])) {
    // catch data
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $username = htmlspecialchars(trim($_POST['username']));
    $user_role = htmlspecialchars(trim($_POST['user_role']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_error = $image['error'];
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);

    // validation
    $errors = [];

    if (empty($first_name)) {
        $errors[] = "first name is required.";
    } elseif (strlen($first_name) > 100) {
        $errors[] = "first name cannot be longer than 100 characters.";
    } elseif(is_numeric($first_name)) {
        $errors[] = "first name must be string";
    }

    if (empty($last_name)) {
        $errors[] = "last name is required.";
    } elseif (strlen($last_name) > 100) {
        $errors[] = "last name cannot be longer than 100 characters.";
    } elseif(is_numeric($last_name)) {
        $errors[] = "last name must be string";
    }

    if (empty($username)) {
        $errors[] = "username is required.";
    } elseif (strlen($username) > 255) {
        $errors[] = "username cannot be longer than 255 characters.";
    } elseif(is_numeric($username)) {
        $errors[] = "username must be string";
    }
    $query = "SELECT username FROM users WHERE username = '$username'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $errors[] = "This username is alredy exist.";
    }

    if(empty($user_role)) {
        $errors[] = "user role is required.";
    } elseif($user_role != "subscriber" && $user_role != "admin") {
        $errors[] = "Error in user role";
    }

    if (empty($email)) {
        $errors[] = "email is required.";
    } elseif (! filter_var($email ,FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email!";
    }
    $query = "SELECT email FROM users WHERE email = '$email'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $errors[] = "This email is alredy exist.";
    }
    
    if (empty($password)) {
        $errors[] = "password is required.";
    } elseif (strlen($password) < 8) {
        $errors[] = "password cannot be less than 8 characters.";
    } elseif(is_numeric($password)) {
        $errors[] = "password must be string & numeric not just numeric!, For your security";
    }

    // Validate image
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
    if(empty($image_name)) {
        $not_has_image = true;
    } elseif(! in_array(strtolower($ext), $allowed_exts)) {
        $errors[] = "Invalid image format. Only jpg, jpeg, png, and gif are allowed.";
    }

    if(empty($errors)) {
        if(isset($not_has_image)) {
            $new_image_name = "";
        } else {
            $new_image_name = uniqid() . '.' . $ext;
        }

        // ===================================================
        // handle password
        $new_password_hashed = password_hash($password, PASSWORD_DEFAULT);

        // ===================================================

        // insert
        $query = "INSERT INTO users(username, password, first_name, last_name, email, image, role)
                    VALUES('$username', '$new_password_hashed', '$first_name', '$last_name', '$email', '$new_image_name', '$user_role')";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            if(! isset($not_has_image)) {
                move_uploaded_file($image_tmp_name, "../../images/users/$new_image_name");
            }
            // save success msg
            $_SESSION['success'] = "User Added Successfully!";
            header("location: ../users.php");
            exit();

        } else {
            // save error msg
            $_SESSION['errors'] = ['Error While Add'];
            header("location: ../users.php?source=Add_users");
            exit();
        }

    } else {
            // save error msg
        $_SESSION['errors'] = $errors;
        header("location: ../users.php?source=Add_users");
        exit();
    }

} else {
    header("location: ../users.php?source=Add_users");
    exit();
}
