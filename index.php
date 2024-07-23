<?php 
session_start(); 

?>
<?php require_once "includes/db.php" ?>



<?php

if(isset($_GET['page'])) {

    if(is_numeric($_GET['page'])) {

        if($_GET['page'] < 1) {
          $page = 1;

        } else {
            $page = abs($_GET['page']);
        }

    } else {
        $page = 1;    }

} else {
    $page = 1;
}

$limit = 3;
$offset = ($page-1) * $limit;

$query = "SELECT count(*) as total FROM posts";
$runQuery = mysqli_query($conn, $query);
$total_posts = mysqli_fetch_assoc($runQuery)['total'];

$number_of_pages = ceil($total_posts / $limit);

if($page > $number_of_pages) {
    header("location: {$_SERVER['PHP_SELF']}?page=$number_of_pages");
}

?>


<?php include "includes/header.php" ?>


<!-- Navigation -->
<?php include "includes/navigation.php" ?>










<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

        <?php
                $query = "SELECT id, title, author, content, image,
                            DATE_FORMAT(created_at, 'Posted on %M %d, %Y at %h:%i %p') as created_at  FROM posts
                            ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
                $runQuery = mysqli_query($conn, $query);
                if(mysqli_num_rows($runQuery) >= 1) {
                    $all_posts = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
                } else {
                    $msg = "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>We Don't Have Any Post Right Now!</div>";
                }
        ?>

        <?php if(isset($all_posts)) : ?>
            <h1 class="page-header" style="margin-top: 20px; font-size: 30px; text-align: center;">
                All Posts
            </h1>
            <?php foreach($all_posts as $post) : ?>

            <!-- Blog Post -->
            <div class="blog-post" style="margin-bottom: 40px; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
                <h2 style="font-size: 28px; color: #333; margin-bottom: 10px;">
                    <span style="font-size: 36px; font-weight: bold; color: #007bff;"><?php echo $post['title']; ?></span>
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
                <?php $content = substr($post['content'], 0, 60) . "..."; ?>
                <p style="font-size: 16px; color: #555;"><?php echo $content; ?></p>

                <form action="post.php" method="post" class="form-inline" style="margin-top: 10px;">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <button type="submit" name="submit_view_post" class="btn btn-primary">
                        Read More <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </form>

                <!-- Custom Divider -->
                <div style="text-align: center; margin-top: 20px;">
                    <hr style="border-top: 1px solid #bf0d2e;">
                </div>
            </div>

            <?php endforeach; ?>
        <?php else : ?>
            <?php echo $msg; ?>
        <?php endif; ?>

        <!-- Pager -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if($page == 1) echo "disabled" ?>"><a class="page-link" href="index.php?page=<?php  echo $page - 1 ?>"> Previos </a></li>
                    <li class="page-item"><a class="page-link" href="#">Page <?php echo $page ?> of <?php echo $number_of_pages ?></a></li>
                    <li class="page-item <?php if($page == $number_of_pages) echo "disabled" ?>"><a class="page-link" href="index.php?page=<?php echo $page + 1 ?>"> Next </a></li>
                </ul>
            </nav>
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/Sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
</div>
