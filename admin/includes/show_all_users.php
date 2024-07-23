<?php
require_once "../includes/success.php";
require_once "../includes/errors.php";


$query = "SELECT id, image, username, first_name, last_name, email, role, created_at FROM users";
$runQuery = mysqli_query($conn, $query);
if(mysqli_num_rows($runQuery) >= 1) { 
    $all_users = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

 } else {
    echo "<div style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin: 10px 0; border-radius: 5px;'>We Dont Have Any user Right Now!</div>";  
}

?>


                        <table class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Admin</th>
                                    <th>Subscriber</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                         <?php if(isset($all_users)) : ?>
                            <?php foreach($all_users as $user) : ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $user['id'] ?></td>
                                        <td><img src="../images/users/<?php echo $user['image']; ?>" alt="Post Image" style="width: 100px; height: auto;"></td>
                                        <td><?php echo $user['username'] ?></td>
                                        <td><?php echo $user['first_name'] ?></td>
                                        <td><?php echo $user['last_name'] ?></td>

                                        <?php 
                                        // $category_id = $post['category_id'];
                                        // $query = "SELECT * FROM categories WHERE id = $category_id";
                                        // $runQuery = mysqli_query($conn, $query);
                                        // $category_title = mysqli_fetch_assoc($runQuery)['title'];
                                        ?>

                                        <!-- <td><a href="categories.php"><?php // echo $category_title ?></a></td> -->
                                        


                                        <td><?php echo $user['email'] ?></td>
                                        <td><?php echo $user['role'] ?></td>
                                        <td><?php echo $user['created_at'] ?></td>

                                        <?php if($user['role'] != "admin") : ?>
                                        <!-- Admin user -->
                                        <td>
                                            <form action="handle_admin/handle_change_user_status.php" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="change_to_admin" style="background-color: purple; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Admin
                                                </button>
                                            </form>
                                        </td> 
                                        <?php else : ?>
                                            <td></td>
                                        <?php endif; ?>

                                        <?php if($user['role'] != "subscriber") : ?>
                                        <!-- Subscriber user -->
                                        <td>
                                            <form action="handle_admin/handle_change_user_status.php" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="change_to_subscriber" style="background-color: orange; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Subscriber
                                                </button>
                                            </form>
                                        </td> 
                                        <?php else : ?>
                                            <td></td>
                                        <?php endif; ?>
 

                                        <!-- Update user -->
                                        <td>
                                            <form action="users.php?source=Edit_user" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="submit_update_user" onclick="return confirm('Are you sure?')" style="background-color: blue; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Delete user -->
                                        <td>
                                            <form action="handle_admin/handle_delete_users.php" method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="submit_delete_user" onclick="return confirm('Are you sure?')" style="background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </table>

                        