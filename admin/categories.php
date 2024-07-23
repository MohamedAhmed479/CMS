<?php session_start(); ?>
<?php include "includes/admin_header.php"; ?>

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
                        require_once "../includes/errors.php";
                        require_once "../includes/success.php";
                        ?>


                        <div class="col-xs-6">
                            <?php if(! isset($_POST['submit_update_category'])) { ?>
                                
                                <form action="handle_admin/handle_add_category.php" method="post">
                                    <div class="form-group">
                                        <label for="cat-title" > Category Tilte </label>
                                        <input class="form-control" type="text" name="cate_title">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Add" name="submit">
                                    </div>
                                </form>

                            <?php } else { ?>

                                <form action="handle_admin/handle_update_category.php" method="post">
                                    <div class="form-group">
                                        <label for="cat-title" > Update Category Tilte </label>
                                        <input class="form-control" type="text" name="cat_title" value="<?php echo $_POST['cat_title'] ?>">
                                    </div>
                                    <input type="hidden" name="cat_id" value="<?php echo $_POST['cat_id'] ?>">

                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit_update_category">
                                    </div>
                                </form>

                            <?php } ?>



                        </div>



                        <div class="col-xs-6">                         
                            <?php
                            $query = "SELECT * FROM categories";
                            $runQuery = mysqli_query($conn, $query); ?> 

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while ($ctegory = mysqli_fetch_assoc($runQuery)) {
                                        $title = $ctegory['title']; 
                                        $cat_id = $ctegory['id']; ?>
                                
                                    <tr>
                                        <td><?php echo $cat_id ?></td>
                                        <td> <a href="../category.php?category_id=<?php echo $cat_id ?>"> <?php echo $title ?></a></td>
                                        <td>
                                            <form action="handle_admin/handle_delete_category.php" method="post">
                                                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                                <button type="submit" name="submit_delete_category" onclick="alert('Are you sure?')" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Delete</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                                                <input type="hidden" name="cat_title" value="<?php echo $title; ?>">
                                                <button type="submit" name="submit_update_category" onclick="alert('Are you sure?')" style="background-color: orange; color: white; border: none; padding: 5px 10px; cursor: pointer;">Update</button>
                                            </form>
                                        </td>
                                    </tr>

                                <?php } ?>

                                </tbody>
                            </table>

                        </div>




                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
<?php include "includes/admin_footer.php"; ?>
