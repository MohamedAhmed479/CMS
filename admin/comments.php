<?php
ob_start();
session_start();
include "includes/admin_header.php"; 

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php if(isset($_SESSION['username'])) echo $_SESSION['username']?></small>
                        </h1>
                    


                        <?php
require_once "../includes/success.php";
require_once "../includes/errors.php";

$query = "SELECT * FROM comments";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) >= 1) { 
    $all_comments = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

 } else {
    echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>We Dont Have Any comment Right Now!</div>";  
}


?>

<?php require_once "../includes/success.php" ?>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Date</th>
                                    <th>In Response To</th>
                                    <th>Status</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    <!-- <th>Edit</th> -->
                                </tr>
                            </thead>

                         <?php if(isset($all_comments)) : ?>
                            <?php foreach($all_comments as $comment) : ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $comment['comment_id'] ?></td>
                                        <td><?php echo $comment['comment_author'] ?></td>
                                        <td><?php echo $comment['comment_email'] ?></td>
                                        <td><?php echo $comment['comment_content'] ?></td>
                                        <td><?php echo $comment['created_at'] ?></td>
                                        <td>
                                            <form action="../post.php" method="post">
                                                <input type="hidden" name="post_id" value="<?php echo $comment['comment_post_id']; ?>">
                                                <button type="submit" name="submit_view_post" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                                                    View Post
                                                </button>
                                            </form>
                                        </td>

                                        <td><?php echo $comment['status'] ?></td>


                                        <?php if($comment['status'] == "unapproved") : ?>
                                        <!-- Approve comment -->
                                        <td>
                                            <form action="handle_admin/handle_change_comment_status.php" method="post">
                                                <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id'] ?>">
                                                <button type="submit" name="submit_approve_comment_status" style="background-color: purple; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Approve
                                                </button>
                                            </form>
                                        </td> 
                                        <?php else : ?>
                                            <td></td>
                                        <?php endif; ?>


                                        <?php if($comment['status'] == "approved") : ?>
                                        <!-- Unapprove comment -->
                                        <td>
                                            <form action="handle_admin/handle_change_comment_status.php" method="post">
                                                <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id'] ?>">
                                                <button type="submit" name="submit_unapprove_comment_status" style="background-color: orange; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Unapprove
                                                </button>
                                            </form>
                                        </td> 
                                        <?php else : ?>
                                            <td></td>
                                        <?php endif; ?>

                                        <!-- Delete Post -->
                                        <td>
                                            <form action="handle_admin/handle_delete_comment.php" method="post">
                                                <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id'] ?>">
                                                <button type="submit" name="submit_delete_comment" onclick="return confirm('Are you sure?')" style="background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Delete
                                                </button>
                                            </form>
                                        </td> 

                                        <!-- Update Post -->
                                        <!-- <td>
                                            <form action="Edit_comments.php" method="post">
                                                <input type="hidden" name="comment_id" value="">
                                                <button type="submit" name="submit_update_comment" onclick="return confirm('Are you sure?')" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Update
                                                </button>
                                            </form>
                                        </td> -->

                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </table>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
<?php include "includes/admin_footer.php"; ?>
