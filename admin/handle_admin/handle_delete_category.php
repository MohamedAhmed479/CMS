<?php
session_start();
require_once "../../includes/db.php";

if(isset($_POST['submit_delete_category'])) {
    $category_id = $_POST['cat_id'];

    $query = "SELECT * FROM categories WHERE id = $category_id";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $query = "DELETE FROM categories WHERE id = $category_id";
        $runQuery = mysqli_query($conn, $query);
    
        if($runQuery) {
            $_SESSION['success'] = "Category Deleted Successfully";
            header("location: ../categories.php");
        } 
    } else {
        $_SESSION['errors'] = ["This category does not exist"];
        header("location: ../categories.php");
    }


}