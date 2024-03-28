<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['success'])):
    ?>
    <aside>
        <p><?php echo $_GET['success']; ?></p>
    </aside>
<?php
endif;
?>
<section>
    <form action="insertData.php" method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <input type="submit" value="Save">
        </div>
    </form>
</section>
<section>
    <table>
        <thead>
        <tr>
            <th>media_id</th>
            <th>user_id</th>
            <th>filename</th>
            <th>filesize</th>
            <th>media_type</th>
            <th>title</th>
            <th>description</th>
            <th>created_at</th>
        </tr>
        </thead>
        <tbody>
        <?php require_once 'selectData.php'; ?>
        </tbody>
    </table>
</section>
</body>
</html>