<?php
session_start();
require_once "../../includes/db.php";

if(isset($_POST['submit_update_category'])) {
    $category_id = $_POST['cat_id'];
    $category_title = htmlspecialchars(trim($_POST['cat_title']));

    if(empty($category_title)) {
        $_SESSION['errors'] = ["Category title can not be empty!"];
        header("location: ../categories.php");
    } else {
        $query = "UPDATE categories SET title = '$category_title' WHERE id = $category_id";
        $runQuery = mysqli_query($conn, $query);
        if($runQuery) {
            $_SESSION['success'] = "Category Updated Successfully!";
            header("location: ../categories.php");
        }
    }

}