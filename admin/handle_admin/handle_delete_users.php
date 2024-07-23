<?php
session_start();
require_once "../../includes/db.php";


 
if(isset($_POST['submit_delete_user'])) {
    $user_id = $_POST['user_id'];

    if($_SESSION['user_id'] == $user_id) {
        $_SESSION['errors'] = ["You can not delete yourself"];
        header("location: ../users.php");
        exit();
    }

    $query = "SELECT id, image FROM users WHERE id = $user_id";
    $runQuery = mysqli_query($conn, $query);

    if(mysqli_num_rows($runQuery) == 1) {
        $image = mysqli_fetch_assoc($runQuery)['image'];

        $query = "DELETE FROM users WHERE id = $user_id";
        $runQuery = mysqli_query($conn, $query);
    
        if($runQuery) {
            if(isset($image)) {
                unlink("../../images/users/$image");
            }

            $_SESSION['success'] = "user Deleted Successfully";
            header("location: ../users.php");
        } 
    } else {
        $_SESSION['errors'] = ["This user does not exist"];
        header("location: ../users.php");
    }
} 