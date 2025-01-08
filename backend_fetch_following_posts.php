<?php 
require('./database_config.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
    $current_user_id = $_SESSION['user_id'];
    $sql = "SELECT posts.*, users.fullname AS user_name, users.profile_pic AS user_profile_pic
            FROM posts
            JOIN users ON posts.user_id = users.user_id
            JOIN followers ON posts.user_id = followers.followed_id
            WHERE followers.follower_id = :follower_id
            ORDER BY posts.created_at DESC";
    $selectPosts = $connect->prepare($sql);
    $selectPosts->bindParam(':follower_id', $current_user_id, PDO::PARAM_INT);
    $selectPosts->execute();
    $posts = $selectPosts->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>