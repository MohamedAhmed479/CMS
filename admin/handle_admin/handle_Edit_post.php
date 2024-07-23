<?php
session_start();
require_once "../../includes/db.php";

if(isset($_POST['submit_Edit_post'])) {
    $old_image = $_POST['old_image'];
    $post_id = $_POST['post_id'];

    // catch data
    $title = htmlspecialchars(trim($_POST['title']));
    $post_category_id = htmlspecialchars(trim($_POST['post_category_id']));
    $tags = htmlspecialchars(trim($_POST['tags']));
    $content = htmlspecialchars(trim($_POST['content']));
    $post_status = htmlspecialchars(trim($_POST['post_status']));

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_error = $image['error'];
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);



    // validation
    $errors = [];

    // Validate title
    if (empty($title)) {
        $errors[] = "Title is required.";
    } elseif (strlen($title) > 255) {
        $errors[] = "Title cannot be longer than 255 characters.";
    }

    // Validate post category ID
    if (empty($post_category_id)) {
        $errors[] = "Post category ID is required.";
    } elseif (!is_numeric($post_category_id)) {
        $errors[] = "Post category ID must be a number.";
    } else {
        $query = "SELECT * FROM categories WHERE id = $post_category_id";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) != 1) {
            $errors[] = "Invalid Post category ID.";
        }
    
    }

    // Validate tags
    if (empty($tags)) {
        $errors[] = "Tags are required.";
    }

    // Validate content
    if (empty($content)) {
        $errors[] = "Content is required.";
    }




    if(empty($image_name)) {
        $No_new_image = true;
    } else {
        // Validate image
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if(! in_array(strtolower($ext), $allowed_exts)) {
            $errors[] = "Invalid image format. Only jpg, jpeg, png, and gif are allowed.";
        }
    }

    
    // Validate post_status
    if (empty($post_status)) {
        $errors[] = "Status is required.";
    } elseif ($post_status != "draft" && $post_status != "published") {
        $errors[] = "Post Status Must Be Draft Or Published!";
    }


    if(empty($errors)) {
        if(isset($No_new_image)) {
            $new_image_name = $old_image;
        } else {
            // Generate a unique name for the image
            $new_image_name = uniqid() . '.' . $ext;
        }

        $query = "UPDATE posts 
                    SET title = '$title', 
                        category_id = '$post_category_id', 
                        image = '$new_image_name', 
                        tags = '$tags', 
                        content = '$content',
                        status = '$post_status' 
                    WHERE id = '$post_id'";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            if(! isset($No_new_image)) {
                unlink("../../images/$old_image");
                move_uploaded_file($image_tmp_name, "../../images/$new_image_name");
            }

            $_SESSION['success'] = "Post Updated Successfully!";
            header("location: ../View_all_posts.php");
        }


    } else {
        print_r($errors);
        $_SESSION['errors'] = $errors;
        header("location: ../View_all_posts.php?source=Edit_post");
    }


} else {
    header("location: ../View_all_posts.php");
}