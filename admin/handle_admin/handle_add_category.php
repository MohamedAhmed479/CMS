<?php
require_once "../../includes/db.php";
session_start(); 


                        if(isset($_POST['submit'])) {
                            $category_title = htmlspecialchars(trim($_POST['cate_title']));

                            if(empty($category_title)) {
                                $_SESSION['errors'] = ["Title is require"];
                                header("location: ../categories.php");

                            } else {
                                $query = "SELECT * FROM categories WHERE title = '$category_title'";
                                $runQuery = mysqli_query($conn, $query); 
                                if(mysqli_num_rows($runQuery)!= 1) {
                                    $query = "INSERT INTO categories(title) VALUES('$category_title')";
                                    $runQuery = mysqli_query($conn, $query);
                                    if($runQuery) {
                                    $_SESSION['success'] = "Category Added Successfully";
                                    header("location: ../categories.php");

                                    }
                                } else {
                                    $_SESSION['errors'] = ["This category already exict"];
                                    header("location: ../categories.php");

                                }

                            }

                        }

                        ?>