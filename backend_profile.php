<?php 
  require('./database_config.php');
  session_start();

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  try {
    $user_id = $_GET['user_id'];

    $sql = "SELECT posts.*, users.fullname AS username, users.profile_pic AS profile_pic
            FROM posts
            INNER JOIN users ON posts.user_id = users.user_id
            WHERE posts.user_id = :user_id";
   
    $selectPosts = $connect->prepare($sql);
    $selectPosts->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $selectPosts->execute();

    $posts = $selectPosts->fetchAll(PDO::FETCH_ASSOC);

    $sqlUsr = "SELECT * FROM users WHERE user_id = :user_id";
    $selectUser = $connect->prepare($sqlUsr);

    $selectUser->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    $selectUser->execute();

    $profile_user = $selectUser->fetch(PDO::FETCH_ASSOC);

    $session_user_id = $_SESSION['user_id'];
    $sqlFollow = "SELECT * FROM followers WHERE follower_id = :user_id";
    $selectFollow = $connect->prepare($sqlFollow);

    $selectFollow->bindParam(':user_id', $session_user_id, PDO::PARAM_INT);
    if ($selectFollow->execute()) {
        $user_followers = $selectFollow->fetchAll(PDO::FETCH_ASSOC);
        $followed_ids = array_column($user_followers, 'followed_id');
        if (count($user_followers) > 0) {
        } else {
            echo "No followers found for user ID: " . $user_id;
        }
    } else {
        echo "Error executing query.";
    }

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>