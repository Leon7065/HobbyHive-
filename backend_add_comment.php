<?php
require('database_config.php');
require('./backend_fetch_post_id.php'); 

if(isset($_POST['add_comment'])){
    if(isset($post) && !empty($post)) {
        $post_id = $_GET['post_id']; 
        $user_id = $_SESSION['user_id']; 
        $content = htmlspecialchars($_POST['content']); 
      
        $query = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        header("Location: ./preview_post.php?post_id=" . $post_id);
    } else {
        echo "Post not found.";
    }
}
?>