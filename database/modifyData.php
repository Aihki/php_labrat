<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
global $DBH;
require_once 'dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        $data = [
            'media_id' => $_POST['media_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'user_id' => $_SESSION['user']['user_id'],


        ];

        $sql = 'UPDATE MediaItems SET title = :title, description= :description WHERE media_id= :media_id AND user_id= :user_id';

        try {
            $STH = $DBH->prepare($sql);
            $STH->execute($data);
            header('Location: home.php?success=Item added');
            if($STH->rowCount() == 0){
                echo "You do not have permission to modify this item.";
            }
        } catch (PDOException $e){
            echo "Could not modify data into the database.";
            file_put_contents('PDOErrors.txt', 'modifyData.php - ' . $e->getMessage(), FILE_APPEND);
        }
    }
}