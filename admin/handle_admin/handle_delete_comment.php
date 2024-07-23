<?php
session_start();
require_once "../../includes/db.php";

if(isset($_POST['submit_delete_comment']) && is_numeric($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    $query = "SELECT * FROM comments WHERE comment_id = $comment_id";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) != 1) {
        header("location: ../comments.php");
        exit();
    }
    $post_id_comment = mysqli_fetch_assoc($runQuery)['comment_post_id'];
    
    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    $runQuery = mysqli_query($conn, $query);
    if($runQuery) {
        $query = "SELECT id, comment_count FROM posts WHERE id = $post_id_comment";
        $runQuery = mysqli_query($conn, $query);
        $post_comment_count_now = mysqli_fetch_assoc($runQuery)['comment_count'];

        $new_post_comment_count =  $post_comment_count_now - 1;
        $query = "UPDATE posts SET comment_count = '$new_post_comment_count' 
                    WHERE id = '$post_id_comment'";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            $_SESSION['success'] = "Comment Deleted Successfully!";
            header("location: ../comments.php");
            exit();
        }

    }

} else {
    header("location: ../comments.php");
    exit();
}

