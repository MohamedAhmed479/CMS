<?php
ob_start();
session_start();
include "includes/admin_header.php"; 


if(! isset($_SESSION['user_id'])) {
    header("location: ../index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id ";
$runQuery = mysqli_query($conn, $query);

if(mysqli_num_rows($runQuery) == 1) {
    $user_info = mysqli_fetch_assoc($runQuery);

    $first_name = $user_info['first_name'];
    $last_name = $user_info['last_name'];
    $role = $user_info['role'];
    $username = $user_info['username'];
    $image = $user_info['image'];
    $email = $user_info['email'];
    $password = $user_info['password'];

} else {
    header("location: index.php");
    exit();
}

?>

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


                    </div>
                </div>
                <!-- /.row -->

                <?php require_once "../includes/errors.php"; ?>

<div class="container">
    <h1 class="mt-5">Edit User</h1>
    <form action="handle_admin/handle_Edit_user.php" method="post" enctype="multipart/form-data">
        
        <div class="row justify-content-center"> 
            <div class="col-md-11">

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $first_name ?>" name="first_name">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $last_name ?>" name="last_name">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">


                <div class="form-group">
                    <label for="user_role">User Role</label>
                    <select class="form-control" name="user_role" id="user_role">
                        <option value="<?php echo $role ?>" > <?php echo $role ?> </option>
                        <option value="admin" >Admin</option>
                        <option value="subscriber" >subscriber</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="<?php echo $username ?>" name="username">
                </div>

                <div class="form-group">
                    <label for="image">Your Image</label>
                    <input type="file" class="form-control-file" name="image">
                </div>

                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" value="<?php echo $email ?>" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password </label>
                    <input type="password" class="form-control" placeholder="If you need change password, Put new password here" name="password">
                </div>

                <button type="submit" name="submit_Edit_user" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>


            </div>
            <!-- /.container-fluid -->

        </div>
       
<?php include "includes/admin_footer.php"; ?>
