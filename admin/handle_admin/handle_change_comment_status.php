<?php

session_start();
require "../../includes/db.php";

if(isset($_POST['submit_approve_comment_status']) && is_numeric($_POST['comment_id'])) {
    // change comment status from unapproved comment to approved comment
    $new_status = "approved";

} elseif(isset($_POST['submit_unapprove_comment_status']) && is_numeric($_POST['comment_id'])) {
    // change comment status from approved comment to unapproved comment
    $new_status = "unapproved";

} else {
    header("location: ../comments.php");
    exit();
}

$comment_id = $_POST['comment_id'];

$query = "SELECT status FROM comments WHERE comment_id = $comment_id";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) != 1) {
    $_SESSION['errors'] = ['This Comment Is not Falid'];
    header("location: ../comments.php");
    exit();
}

// comment is exist
$old_status = mysqli_fetch_assoc($runQuery)['status'];

if($old_status == $new_status) {
    $error = "This Comment Is Alredy $new_status";
    $_SESSION['errors'] = [$error];
    header("location: ../comments.php");
    exit();
}


$query = "UPDATE comments SET status = '$new_status'
            WHERE comment_id = $comment_id";
$runQuery = mysqli_query($conn, $query);
if($runQuery) {
    if($new_status == "approved") {
        $success_msg = "This comment has now been approved for display";
    } else {
        $success_msg = "You have made this comment unapproved";
    }
    $_SESSION['success'] = $success_msg;
    header("location: ../comments.php");
    exit();
}
