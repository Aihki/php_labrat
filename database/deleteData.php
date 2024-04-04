<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
global $DBH;
require_once 'dbConnect.php';

if (isset($_GET['id'])) {
    $DBH->beginTransaction();
    $data = [
        'media_id' => $_GET['id'],
    ];

    //delete likes
    $sql = 'DELETE FROM Likes WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);

    } catch (PDOException $e) {
        echo "Could not delete likes from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    };
    //delete comments
    $sql = 'DELETE FROM Comments WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);

    } catch (PDOException $e) {
        echo "Could not delete comments from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    };
    //delete ratings
    $sql = 'DELETE FROM Ratings WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);

    } catch (PDOException $e) {
        echo "Could not delete ratings from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    };
    //delete mediaItemTags
    $sql = 'DELETE FROM MediaItemTags WHERE media_id = :media_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
    } catch (PDOException $e) {
        echo "Could not delete mediaItemTags from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    };

    $data['user_id'] = $_SESSION['user']['user_id'];

    //delete file from server
    $sql = 'SELECT filename FROM MediaItems WHERE media_id = :media_id  AND user_id = :user_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $row = $STH->fetch();
        $filename = $row['filename'];
        $destination = __DIR__ . '/uploads/' . $filename;
        if (!unlink($destination)) {
            header('Location: home.php?success=File delete failed');
            $DBH->rollBack();
            exit;
        }
    } catch (PDOException $e) {
        echo "Could not get filename from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }

    //delete mediaItems
    $sql = 'DELETE FROM MediaItems WHERE media_id = :media_id AND user_id = :user_id';
    try {
        $STH = $DBH->prepare($sql);
        $STH->execute($data);
        $DBH->commit();
        if($STH->rowCount() == 0){
            echo "You do not have permission to delete this item.";
            exit;
        }
        header('Location: home.php?success=Item deleted');

    } catch (PDOException $e) {
        echo "Could not delete data from the database.";
        file_put_contents('PDOErrors.txt', 'deleteData.php - ' . $e->getMessage(), FILE_APPEND);
        $DBH->rollBack();
        exit;
    }


}