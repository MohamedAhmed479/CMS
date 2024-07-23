<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                    $query = "SELECT * FROM categories";
                    $runQuery = mysqli_query($conn, $query);

                    while ($ctegory = mysqli_fetch_assoc($runQuery)) {
                    $title = $ctegory['title']; 
                    $category_id = $ctegory['id']; ?>
                    <li>
                        <a href="category.php?category_id=<?php echo $category_id ?>"> <?php echo $title ?> </a>
                    </li>
                    <?php } ?>
                    
                    <li>
                        <a href="admin">Admin</a>
                    </li>

                    <?php if(isset($_SESSION['user_id'])) : ?>
                     <li>
                        <a href="admin/handle_admin/handle.logout.php">Log out</a>
                    </li>
                    <?php endif; ?>


                   
                   <!--<li>
                        <a href="#">Contact</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>