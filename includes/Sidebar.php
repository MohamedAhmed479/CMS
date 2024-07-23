<div class="col-md-4">


<?php include "login_page.php" ?>


<!-- Blog Search Well --> 
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
        <div class="input-group">

            <input type="text" name="search" class="form-control">

            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>

        </div>
    </form>
    <!-- /.input-group -->
</div>



<?php

    $query = "SELECT * FROM categories";
    $runQuery = mysqli_query($conn, $query); ?>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
    <?php 
    
    while ($ctegory = mysqli_fetch_assoc($runQuery)) {
    $title = $ctegory['title'];
    $id = $ctegory['id']; ?>


    <li>
        <a href="category.php?category_id=<?php echo $id ?>"> <?php echo $title ?> </a>
    </li>

<?php } ?>


            </ul>
        </div>


    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<?php require_once "includes/widget.php" ?>

</div>