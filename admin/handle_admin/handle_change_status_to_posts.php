<?php


foreach ($_POST['checkBoxArray'] as $post_id) {
    $if_exist_post_query = "SELECT id FROM posts WHERE id = $post_id";
    $runQuery = mysqli_query($conn, $if_exist_post_query);

    if(mysqli_num_rows($runQuery) == 1) {
        $query = "UPDATE posts SET status = '$change_to' WHERE id = $post_id";
        $runQuery = mysqli_query($conn, $query);
    }
}

