<?php 
require('./database/config.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
    $sql = "SELECT posts.*, users.fullname AS user_name, users.profile_pic AS user_profile_pic
            FROM posts
            JOIN users ON posts.user_id = users.user_id
            ORDER BY posts.created_at DESC";
            $selectPosts = $connect->prepare($sql);
            $selectPosts->execute();
            $posts = $selectPosts->fetchAll();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>