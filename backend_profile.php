<?php 
  require('./database_config.php');
  session_start();

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  try {
    $user_id = $_GET['user_id'] ?? $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $connect->prepare($query);
    $stmt->execute([$user_id]);
    $profile_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $followers_query = "SELECT COUNT(*) AS followers_count FROM followers WHERE followed_id = ?";
    $stmt = $connect->prepare($followers_query);
    $stmt->execute([$user_id]);
    $followers_count = $stmt->fetchColumn();

    $following_query = "SELECT COUNT(*) AS following_count FROM followers WHERE follower_id = ?";
    $stmt = $connect->prepare($following_query);
    $stmt->execute([$user_id]);
    $following_count = $stmt->fetchColumn();

    $posts_query = "SELECT COUNT(*) AS posts_count FROM posts WHERE user_id = ?";
    $stmt = $connect->prepare($posts_query);
    $stmt->execute([$user_id]);
    $posts_count = $stmt->fetchColumn();

    $posts_query = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = $connect->prepare($posts_query);
    $stmt->execute([$user_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $followed_query = "SELECT followed_id FROM followers WHERE follower_id = ?";
    $stmt = $connect->prepare($followed_query);
    $stmt->execute([$_SESSION['user_id']]);
    $followed_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

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
