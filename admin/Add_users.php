<?php require_once "../includes/errors.php"; ?>

<div class="container">
    <h1 class="mt-5">Add New User</h1>
    <form action="handle_admin/handle_add_users.php" method="post" enctype="multipart/form-data">
        
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" name="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" name="last_name">
                </div>



                <div class="form-group">
                    <label for="user_role">User Role</label>
                    <select class="form-control" name="user_role">
                        <option value="subscriber">Select Role</option>
                        <option value="admin" >Admin</option>
                        <option value="subscriber" >subscriber</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username">
                </div>

                <div class="form-group">
                    <label for="image">Your Image</label>
                    <input type="file" class="form-control-file" name="image">
                </div>

                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <button type="submit" name="submit_add_user" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>