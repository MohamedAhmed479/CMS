
<?php 

if(isset($_POST['submit_update_post'])) {
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_image = $_POST['post_image'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_status = $_POST['post_status'];


    $query = "SELECT title FROM categories WHERE id = $post_category_id ";
    $runQuery = mysqli_query($conn, $query);
    if(mysqli_num_rows($runQuery) == 1) {
        $category = mysqli_fetch_assoc($runQuery)['title'];
    } else {
        header("location: View_all_posts.php");
        exit();
    }

} else {
    header("location: View_all_posts.php");
    exit();
}

?>

<?php require_once "../includes/errors.php"; ?>

    <div class="container">
        <h1 class="mt-5">Edit Post</h1>
        <form action="handle_admin/handle_Edit_post.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" value="<?php echo $post_title ?>" name="title" id="title">
            </div>

            <?php 
            $query = "SELECT * FROM categories";
            $runQuery = mysqli_query($conn, $query);
            if(mysqli_num_rows($runQuery) >= 1) {
                $all_categories = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);
            } 
            ?>

            <div class="form-group">
                <label for="post_category_id">Post Category</label>
                <select class="form-control" name="post_category_id" id="post_category">
                    <option value="<?php echo $post_category_id ?>"><?php echo $category ?></option>
                    <?php if(isset($all_categories)) : ?>
                        <?php foreach ($all_categories as $category) : ?>
                            <option value="<?php echo $category['id'] ?>" > <?php echo $category['title'] ?> </option>
                            <?php endforeach; ?>
                    <?php endif; ?>
                
                </select>
            </div>


            <div class="form-group">
                <label for="post_category_id">Post Status</label>
                <select class="form-control" name="post_status" id="post_status">
                    <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>

                        <?php if($post_status == "published") :?>
                            <option value="draft" > Draft </option>
                        <?php else : ?>
                            <option value="published" > published </option>
                        <?php endif; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="image">Post Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
                <br>
                <label>Current Image:</label>
                <img src="../images/<?php echo $post_image ?>" alt="Post Image" style="width: 100px; height: auto;">
            </div>

            <div class="form-group">
                <label for="tags">Post Tags</label>
                <input type="text" class="form-control" value="<?php echo $post_tags ?>" name="tags" id="tags">
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" name="content" id="content" rows="5"><?php echo $post_content ?></textarea>
            </div>
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <input type="hidden" name="old_image" value="<?php echo $post_image ?>">

            <button type="submit" name="submit_Edit_post" class="btn btn-primary">Submit</button>
        </form>
    </div>
