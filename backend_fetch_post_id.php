<?php 
  require('./database/config.php');
  session_start();
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  try {
      $post_id = $_GET['post_id'] ?? null;
      if ($post_id) {
        $sql = "SELECT posts.*, users.fullname AS username, users.profile_pic AS profile_pic
                FROM posts
                INNER JOIN users ON posts.user_id = users.user_id
                WHERE posts.post_id = :post_id";
        $selectPosts = $connect->prepare($sql);
        $selectPosts->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $selectPosts->execute();
        $post = $selectPosts->fetch();
    } else {
        echo "Post ID is not specified.";
    }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
?>