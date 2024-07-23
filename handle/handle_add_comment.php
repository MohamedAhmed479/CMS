<?php
session_start();
require_once "../includes/db.php";

if(isset($_POST['submit_add_comment'])) {
    $comment_post_id = htmlspecialchars(trim($_POST['comment_post_id']));
    $comment_author = htmlspecialchars(trim($_POST['comment_author']));
    $comment_email = htmlspecialchars(trim($_POST['comment_email']));
    $comment_content = htmlspecialchars(trim($_POST['comment_content']));


    $errors = [];

    $query = "SELECT * FROM posts WHERE id = '$comment_post_id'";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) != 1) {
        $errors[] = "Enter a valid data please";
    } else {
        $post_comment_count_now = mysqli_fetch_assoc($runQuery)['comment_count'];
    }

    if(empty($comment_author)) {
        $errors[] = "Your Name Is Required!";
    } elseif(is_numeric($comment_author)) {
        $errors[] = "Your Name Must Be String!";
    }

    if(empty($comment_email)) {
        $errors[] = "Your Email Is Required!";
    } elseif(! filter_var($comment_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email!";
    }

    if(empty($comment_content)) {
        $errors[] = "Your Comment Content Is Required!";
    }

    if(empty($errors)) {
        // Data is valid
        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, status) 
                    VALUES('$comment_post_id', '$comment_author', '$comment_email', '$comment_content', 'unapproved')";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            $new_post_comment_count =  $post_comment_count_now + 1;
            $query = "UPDATE posts SET comment_count = '$new_post_comment_count' 
                        WHERE id = '$comment_post_id'";
            $runQuery = mysqli_query($conn, $query);
            if($runQuery) {
                $_SESSION['success'] = "Comment has been sent";
                $_SESSION['post_id'] = $comment_post_id;
                header("location: ../post.php");
            }

        }






    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['post_id'] = $comment_post_id;
        header("location: ../post.php");
    }

} else {
    header("location: ../index.php");
}