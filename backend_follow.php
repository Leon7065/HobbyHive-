<?php
  session_start();
  require('./database_config.php');

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  try {
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to follow users.");
    }

    $follower_id = $_SESSION['user_id'];
    $followed_id = $_GET['follow_user'];

    $sql = "INSERT INTO followers (follower_id, followed_id, created_at) VALUES (:follower_id, :followed_id, NOW())";

    $stmt = $connect->prepare($sql);

    $stmt->bindParam(':follower_id', $follower_id, PDO::PARAM_INT);
    $stmt->bindParam(':followed_id', $followed_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "You are now following the user.";
    } else {
        echo "Error: Unable to follow the user.";
    }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }

?>