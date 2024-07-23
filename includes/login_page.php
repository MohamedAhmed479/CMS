<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php require_once "errors.php" ?>
<?php require_once "success.php" ?>

<?php if (!isset($_SESSION['user_id'])) : ?>
    <div class="login-box">
        <form action="handle/handle_login.php" method="post">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" required>
            </div>
            <button type="submit" name="login_submit" class="btn btn-primary">Login</button>
        </form>

        <!-- Add a link to direct the user to the registration page -->
        <div class="form-group" style="text-align: center; margin-top: 10px;">
            <p><strong>Don't have an account?</strong><br>
            <a href="registration.php">Create a new account</a></p>
        </div>

    </div>
<?php endif; ?>
