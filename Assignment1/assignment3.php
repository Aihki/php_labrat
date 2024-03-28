<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remember'])){
        $_SESSION['username'] = $_POST['username'];
    } else {
        unset($_SESSION['username']);
    }

}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="username">Username</label>
    <input <?php
    if (isset($_SESSION['username'])) {
        echo 'value="' . $_SESSION['username'] . '"';
    }
    ?> type="text" name="username" id="username">

    <label for="remember">Remember</label>
    <input
        <?php
        if (isset($_SESSION['username'])) {
            echo 'checked';
        }
        ?> type="checkbox" name="remember" id="remember">

    <button type="submit">Submit</button>
</form>


