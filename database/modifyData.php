<?php
global $DBH;
require 'dbConnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        $data = [
            'media_id' => $_POST['media_id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],

        ];

        $sql = 'UPDATE MediaItems SET title = :title, description= :description WHERE media_id= :media_id';

        try {
            $STH = $DBH->prepare($sql);
            $STH->execute($data);
            header('Location: index.php?success=Item added');
        } catch (PDOException $e){
            echo "Could not modify data into the database.";
            file_put_contents('PDOErrors.txt', 'modifyData.php - ' . $e->getMessage(), FILE_APPEND);
        }
    }
}