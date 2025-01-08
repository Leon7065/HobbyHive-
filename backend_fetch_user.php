<?php 
  require('./database/config.php');
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  if (isset($_SESSION['user_id'])) {
    try {
      $sql = "SELECT * FROM users WHERE user_id = :user_id";
      $selectUser = $connect->prepare($sql);
      $selectUser->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
      $selectUser->execute();
      $user = $selectUser->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  } else {
    echo "User is not logged in.";
  }
?>