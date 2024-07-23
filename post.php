<?php 
session_start();
if(! isset($_POST["submit_view_post"])) {
    if(isset($_SESSION['post_id'])) {
        $post_id = $_SESSION['post_id'];
    } elseif($_GET['post_id']) {
        $post_id = $_GET['post_id'];
    } else {
        header("location: index.php");
        exit();
    }

} else {
    $post_id = $_POST['post_id'];
}
?>



<?php require_once "includes/db.php" ?>
<?php include "includes/header.php" ?>




<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<?php require_once "includes/success.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php
            $query = "SELECT id, title, author, content, image, tags, status, category_id , post_views_count,
                      DATE_FORMAT(created_at, 'Posted on %M %d, %Y at %h:%i %p') as created_at  
                      FROM posts 
                      WHERE id = $post_id";
            $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) == 1) {
                $post = mysqli_fetch_assoc($runQuery);
            } else {
                $msg = "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>This Post Is Not Found!</div>";
            }
        ?>

<?php

if(isset($_SESSION['user_id'])) {
    $old_post_views_count = $post['post_views_count'];
    $new_post_views_count = $old_post_views_count + 1;
    
    $query_update = "UPDATE posts SET post_views_count = $new_post_views_count WHERE id = $post_id ";
    $runQuery = mysqli_query($conn, $query_update);
}



?>

        <?php if(isset($post)) : ?>
            <h1 class="page-header" style="margin-top: 20px; font-size: 30px; text-align: center;">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <div class="blog-post" style="margin-bottom: 40px; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                <h2 style="font-size: 28px; color: #333; margin-bottom: 10px;">
                    <a href="#" style="color: #007bff; text-decoration: none;"><?php echo $post['title']; ?></a>
                </h2>

                <h3 style="font-size: 20px; color: #666; margin-bottom: 10px;">
                    by:
                    <a href="posts_of_user.php?author=<?php echo $post['author']; ?>" style="color: #007bff; text-decoration: none;">
                        <?php echo $post['author']; ?>
                    </a>
                </h3>

                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post['created_at']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post['image']; ?>" alt="" style="width: 100%; height: auto; border-radius: 10px;">
                <hr>
                <p style="font-size: 16px; color: #555;"><?php echo $post['content']; ?></p>
                <hr>
            </div>

            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == "admin") : ?>
                <!-- Buttons for Edit and Delete -->
                <form action="admin/View_all_posts.php?source=Edit_post" method="post" style="display: inline;">

                    <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                    <input type="hidden" name="post_title" value="<?php echo $post['title'] ?>">
                    <input type="hidden" name="post_category_id" value="<?php echo $post['category_id'] ?>">
                    <input type="hidden" name="post_author" value="<?php echo $post['author'] ?>">
                    <input type="hidden" name="post_image" value="<?php echo $post['image'] ?>">
                    <input type="hidden" name="post_tags" value="<?php echo $post['tags'] ?>">
                    <input type="hidden" name="post_content" value="<?php echo $post['content'] ?>">
                    <input type="hidden" name="post_status" value="<?php echo $post['status'] ?>">
                
                    <button type="submit" name="submit_update_post" class="btn btn-warning">Edit Post</button>

                </form>

                <form action="admin/handle_admin/handle_delete_post.php" method="post" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                    <button type="submit" name="submit_delete_post" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                </form>
            <?php endif; ?>

                

        <?php else : ?>
            <?php echo $msg ?>
        <?php endif ; ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/Sidebar.php" ?>

    </div>
    <!-- /.row -->

    

    <hr>

    <!-- Blog Comments -->
    <?php require_once "includes/errors.php" ?>
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form action="handle/handle_add_comment.php" method="post" role="form">

            <label for="comment_author">Your Name</label>
            <div class="form-group">
                <input type="text" class="form-control" name="comment_author" id="">
            </div>

            <input type="hidden" name="comment_post_id" value="<?php echo $post_id ?>">

            <label for="comment_email">Your Email</label>
            <div class="form-group">
                <input type="email" class="form-control" name="comment_email" id="">
            </div>

            <label for="comment_content">Your Comment</label>
            <div class="form-group">
                <textarea name="comment_content" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" name="submit_add_comment" class="btn btn-primary">Send</button>
        
        </form>
    </div>

    <hr>

    <!-- Posted Comments -->
    <?php
        $query = "SELECT comment_author, comment_content, 
                  DATE_FORMAT(created_at, '%M %d, %Y at %h:%i %p') as created_at
                  FROM comments 
                  WHERE comment_post_id = $post_id AND status = 'approved'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery) >= 1) { 
            $all_comments = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
        } else {
            echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>We Don't Have Any Comment Right Now!</div>";  
        }
    ?>

    <?php if(isset($all_comments)) : ?>
        <?php foreach($all_comments as $comment) : ?>
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $comment['comment_author'] ?>
                        <small><?php echo $comment['created_at'] ?></small>
                    </h4>
                    <?php echo $comment['comment_content'] ?>
                </div>
            </div>
        <?php endforeach; ?>    
        <?php endif; ?>

<!-- Footer -->
<?php include "includes/footer.php" ?>
