<?php 
require('./database_config.php');
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        $sql = "SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC"; 
        $selectPosts = $connect->prepare($sql);
        $selectPosts->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $selectPosts->execute();

        $posts = $selectPosts->fetchAll();
    } else {
        echo "User is not logged in.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
