<?php 

// posts
$query_to_count_posts = "SELECT COUNT(*) as count_posts FROM posts";
$run_query_to_count_posts = mysqli_query($conn, $query_to_count_posts);
$count_posts = mysqli_fetch_assoc($run_query_to_count_posts)['count_posts'];

// comments
$query_to_count_comments = "SELECT COUNT(*) as count_comments FROM comments";
$run_query_to_count_comments = mysqli_query($conn, $query_to_count_comments);
$count_comments = mysqli_fetch_assoc($run_query_to_count_comments)['count_comments'];


// users
$query_to_count_users = "SELECT COUNT(*) as count_users FROM users";
$run_query_to_count_users = mysqli_query($conn, $query_to_count_users);
$count_users = mysqli_fetch_assoc($run_query_to_count_users)['count_users'];


// Categories
$query_to_count_Categories = "SELECT COUNT(*) as count_categories FROM Categories";
$run_query_to_count_Categories = mysqli_query($conn, $query_to_count_Categories);
$count_categories = mysqli_fetch_assoc($run_query_to_count_Categories)['count_categories'];


?>





<!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $count_posts ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="View_all_posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View All Posts</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $count_comments ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View All Comments</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $count_users ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View All Users</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $count_categories ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View All Categories</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->