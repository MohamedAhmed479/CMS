<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        
                        <h1 style="text-align: center; color: #337ab7; margin-bottom: 20px;">Register</h1>
<?php  include "includes/errors.php"; ?>
                        
                        <form role="form" action="handle/handle_add_users.php" method="post" id="login-form" autocomplete="off" enctype="multipart/form-data">
                            
                            <label for="first_name"> First Name</label>
                            <div class="form-group">
                                <label for="first_name" class="sr-only">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name" style="margin-bottom: 15px;">
                            </div>

                            <label for="last_name"> Last Name</label>
                            <div class="form-group">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name" style="margin-bottom: 15px;">
                            </div>

                            <label for="username"> Username</label>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" style="margin-bottom: 15px;">
                            </div>

                            <label for="email"> Email</label>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" style="margin-bottom: 15px;">
                            </div>

                            <label for="password"> Password</label>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password" style="margin-bottom: 15px;">
                            </div>

                            <label for="image"> Profile Image</label>
                            <div class="form-group">
                                <label for="image" class="sr-only">Profile Image</label>
                                <input type="file" name="image" id="image" class="form-control" style="margin-bottom: 15px;">
                            </div>
                            <input type="submit" name="submit_add_user" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" style="background-color: #337ab7; color: white; margin-top: 10px;">
                        </form>
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>
    <hr>
</div> <!-- /.container -->

<?php include "includes/footer.php";?>
