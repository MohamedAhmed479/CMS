<?php
session_start();
require_once "../../includes/db.php";

if(isset($_POST['submit_delete_post'])) {
    $post_id = $_POST['post_id'];

    $query = "SELECT id, image FROM posts WHERE id = $post_id";
    $runQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($runQuery) == 1) {
        $image = mysqli_fetch_assoc($runQuery)['image'];

        $query = "DELETE FROM posts WHERE id = $post_id";
        $runQuery = mysqli_query($conn, $query);
    
        if($runQuery) {
            unlink("../../images/$image");
            $_SESSION['success'] = "Post Deleted Successfully";
            header("location: ../View_all_posts.php");
        } 
    } else {
        $_SESSION['errors'] = ["This post does not exist"];
        header("location: ../View_all_posts.php");
    }
} 