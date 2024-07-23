<?php require_once "../includes/errors.php"; ?>
    <div class="container">
        <h1 class="mt-5">Add New Post</h1>
        <form action="handle_admin/handle_add_post.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" class="form-control" name="title" id="title">
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
                    <option value="">Select category</option>
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
                    <option value="draft"> Draft </option>
                    <option value="published" > published </option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Post Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="tags">Post Tags</label>
                <input type="text" class="form-control" name="tags" id="tags">
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea class="form-control" name="content" id="content" rows="5"></textarea>
            </div>

            <button type="submit" name="submit_add_post" class="btn btn-primary">Submit</button>
        </form>
    </div>
