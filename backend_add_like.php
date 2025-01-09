<?php
require('./database_config.php');

session_start();
$user_id = $_SESSION['user_id'];

if (isset($_GET['post_id']) && isset($_GET['user_id'])) {
    $post_id = $_GET['post_id'];
    $user_id = $_GET['user_id'];

    $stmt = $connect->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
    $stmt->execute([$user_id, $post_id]);
    
    if ($stmt->rowCount() > 0) {
        $deleteStmt = $connect->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
        $deleteStmt->execute([$user_id, $post_id]);
    } else {
        $insertStmt = $connect->prepare("INSERT INTO likes (user_id, post_id, created_at) VALUES (?, ?, NOW())");
        $insertStmt->execute([$user_id, $post_id]);
    }

    header("Location: ./index.php ");
    exit();
}
?>