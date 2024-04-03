<?php
session_start();
require_once __DIR__. '/inc/header.php';
?>

<section>
    <!-- login form with username and password -->
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <div>
                <input type="submit" value="Login">
            </div>
    </form>
</section>
<section>
    <!-- register form with username , password and email -->
    <h2>Register</h2>
    <form action="register.php" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
</section>
<?php
require_once __DIR__. '/inc/footer.php';
?>

