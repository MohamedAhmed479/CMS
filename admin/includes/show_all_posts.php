<?php
require_once "../includes/success.php";
require_once "../includes/errors.php";

if(isset($_POST['checkBoxArray']) && isset($_POST['bulk_options'])) {

    $bulk_options = $_POST['bulk_options'];

    switch ($bulk_options) {
        case 'published':
            $change_to = "published";
            require_once "handle_admin/handle_change_status_to_posts.php";
            break;
        
        case 'draft':
            $change_to = "draft";
            require_once "handle_admin/handle_change_status_to_posts.php";
            break;

        case 'delete':
            require_once "includes/delete_many_posts.php";
            break; 
        
        case 'clone':
            require_once "includes/clone_posts.php";
            break; 
    }
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

$limit = 10;
$offset = ($page-1) * $limit;

$query = "SELECT count(*) as total FROM posts";
$runQuery = mysqli_query($conn, $query);
$total_posts = mysqli_fetch_assoc($runQuery)['total'];

$number_of_pages = ceil($total_posts / $limit);

if($page > $number_of_pages) {
    header("location: {$_SERVER['PHP_SELF']}?page=$number_of_pages");
}



$query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) >= 1) { 
    $all_posts = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

 } else {
    echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>We Dont Have Any Post Right Now!</div>";  
}


?>





<form action="" method="post">

<table class="table table-bordered table-hover">

                            <div id="bulkOptionsContainer" class="col-xs-4">
                                
                                <select class="form-control" name="bulk_options" id="">
                                    <option value="">Select Options</option>
                                    <option value="published">Publish</option>
                                    <option value="draft">Draft</option>
                                    <option value="delete">Delete</option>
                                    <option value="clone">Clone</option>
                                </select>

                            </div>

                            <div class="col-xs-4">
                                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                                <a class="btn btn-primary" href="View_all_posts.php?source=Add_posts">Add new</a>
                            </div>

                            <br>
                            <br>


                            <thead>
                                <tr>
                                    <th> * </th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>

                         <?php if(isset($all_posts)) : ?>
                            <?php foreach($all_posts as $post) : ?>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post['id'] ?>"></td>
                                        <td><?php echo $post['id'] ?></td>
                                        <td><?php echo $post['author'] ?></td>
                                        <td><?php echo $post['title'] ?></td>
                                        <td><img src="../images/<?php echo $post['image']; ?>" alt="Post Image" style="width: 100px; height: auto;"></td>
                                        
                                        <?php 
                                        $category_id = $post['category_id'];
                                        $query = "SELECT * FROM categories WHERE id = $category_id";
                                        $runQuery = mysqli_query($conn, $query);
                                        $category_title = mysqli_fetch_assoc($runQuery)['title'];
                                        ?>

                                        <td><a href="categories.php"><?php echo $category_title ?></a></td>
                                        


                                        <td><?php echo $post['status'] ?></td>
                                        <td><?php echo $post['tags'] ?></td>
                                        <td> <a href="comments_for_post.php?post_id=<?php echo $post['id'] ?>"><?php echo $post['comment_count'] ?></a></td>
                                        <td><?php echo $post['post_views_count'] ?></td>
                                        <td><?php echo $post['created_at'] ?></td>

                                        <td>
                                            <!-- <form action="../t.php" method="post">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <button type="submit" name="submit_view_post" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                                                    View
                                                </button>
                                            </form> -->
                                        

                                        <a href="../post.php?post_id=<?php echo $post['id']; ?>" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; display: inline-block; text-align: center;">
                                            View
                                        </a>

                                        </td>

                                        <!-- Delete Post -->
                                        <td>
                                            <form action="handle_admin/handle_delete_post.php" method="post">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                <button type="submit" name="submit_delete_post" onclick="alert('Are you sure?')" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Delete</button>
                                            </form>
                                        </td>

                                        

                                        <!-- Update Post -->
                                        <td>
                                            <form action="View_all_posts.php?source=Edit_post" method="post">
                                                <input type="hidden" name="post_id" value="<?php echo $post['id'] ?>">
                                                
                                                <input type="hidden" name="post_title" value="<?php echo $post['title'] ?>">
                                                <input type="hidden" name="post_category_id" value="<?php echo $post['category_id'] ?>">
                                                <input type="hidden" name="post_author" value="<?php echo $post['author'] ?>">
                                                <input type="hidden" name="post_image" value="<?php echo $post['image'] ?>">
                                                <input type="hidden" name="post_tags" value="<?php echo $post['tags'] ?>">
                                                <input type="hidden" name="post_content" value="<?php echo $post['content'] ?>">
                                                <input type="hidden" name="post_status" value="<?php echo $post['status'] ?>">

                                                <button type="submit" name="submit_update_post" onclick="alert('Are you sure?')" style="background-color: orange; color: white; border: none; padding: 5px 10px; cursor: pointer;">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            <?php endif; ?>


                        </table>
            
                        </form>
                        <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item <?php if($page == 1) echo "disabled" ?>"><a class="page-link" href="View_all_posts.php?page=<?php  echo $page - 1 ?>"> Previos </a></li>
                                    <li class="page-item"><a class="page-link" href="#">Page <?php echo $page ?> of <?php echo $number_of_pages ?></a></li>
                                    <li class="page-item <?php if($page == $number_of_pages) echo "disabled" ?>"><a class="page-link" href="View_all_posts.php?page=<?php echo $page + 1 ?>"> Next </a></li>
                                </ul>
                        </nav>
