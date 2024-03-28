<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remember'])) {
        setcookie('username', $_POST['username']);
    } else {
        setcookie('username', '', time() - 3600);
    }
    header('location:', $_POST['PHP_SELF']);

}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Username</label>
    <input <?php
    if (isset($_COOKIE['username'])) {
        echo 'value="' . $_COOKIE['username'] . '"';
    }
    ?> type="text" name="username" id="username">

    <label for="remember">Remember</label>
    <input
        <?php
        if (isset($_COOKIE['username'])) {
            echo 'checked';
        }
        ?> type="checkbox" name="remember" id="remember">

    <button type="submit">Submit</button>
</form>

