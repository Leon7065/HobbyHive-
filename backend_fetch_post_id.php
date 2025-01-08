<?php 
  require('./database/config.php');
  session_start();
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  try {
      $post_id = $_GET['post_id'] ?? null;
    if($post_id){
      $sql = "SELECT * FROM posts WHERE post_id = :post_id"; 
      $selectPosts = $connect->prepare($sql);
      $selectPosts->bindParam(':post_id', $postId, PDO::PARAM_INT);
      $selectPosts->execute();
      $posts = $selectPosts->fetchAll();
    }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
?>