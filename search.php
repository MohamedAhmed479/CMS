<?php require_once "includes/db.php" ?>
<?php include "includes/header.php" ?>

<?php


?>



<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
                        
        <?php 
        if(isset($_POST['search']) && isset($_POST['submit']) || isset($_GET['search'])) {
            if(isset($_GET['search'])) {
                $search =  $_GET['search'];
            } else {
                $search =  $_POST['search'];

            }


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
            
            $query = "SELECT count(*) as total FROM posts WHERE tags LIKE '%$search%'";
            $runQuery = mysqli_query($conn, $query);
            $total_posts = mysqli_fetch_assoc($runQuery)['total'];
            
            $number_of_pages = ceil($total_posts / $limit);
            
            if($page > $number_of_pages) {
                header("location: {$_SERVER['PHP_SELF']}?page=$number_of_pages");
            }



            $query = "SELECT id, title, author, content, image, DATE_FORMAT(created_at, 'Posted on %M %d, %Y at %h:%i %p') as created_at
                        FROM posts WHERE tags LIKE '%$search%' 
                        ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
            $runQuery = mysqli_query($conn, $query);

            if(! $runQuery) {
                die("QUERY_FAILED" . mysqli_error($conn));
            }
            
            ?>
                    <h1 class="page-header" style="margin-top: 20px; font-size: 30px; text-align: center;">
                        Search for 
                        <small> <?php echo $search ?> </small>
                    </h1>

<?php
            if(mysqli_num_rows($runQuery) >= 1) {
                $all_posts = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

                foreach($all_posts as $post) { ?>


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
                        <form action="post.php" method="post" class="form-inline" style="margin-top: 10px;">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" name="submit_view_post" class="btn btn-primary">
                                Read More <span class="glyphicon glyphicon-chevron-right"></span>
                            </button>
                        </form>

                    </div>

                <?php } ?>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?php if($page == 1) echo "disabled" ?>"><a class="page-link" href="search.php?page=<?php  echo $page - 1 ?>&&search=<?php echo $search ?>"> Previos </a></li>
                            <li class="page-item"><a class="page-link" href="#">Page <?php echo $page ?> of <?php echo $number_of_pages ?></a></li>
                            <li class="page-item <?php if($page == $number_of_pages) echo "disabled" ?>"><a class="page-link" href="search.php?page=<?php echo $page + 1 ?>&&search=<?php echo $search ?>"> Next </a></li>
                        </ul>
                    </nav>
                

            <?php } else {
                echo "<h1 style='text-align: center; color: #bf0d2e;'>No Result</h1>";
            }
        
        } else {
            header("location: index.php");
        }
        ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/Sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
</div>
