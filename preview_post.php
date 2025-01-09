<?php 
require('./backend_fetch_post_id.php');
require('./database_config.php');
$query_likes = "SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?";
$stmt_likes = $connect->prepare($query_likes);
$stmt_likes->execute([$post['post_id']]);
$likes = $stmt_likes->fetch(PDO::FETCH_ASSOC);
$like_count = $likes['like_count'];
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = $_SESSION['user_id']; 
$query_is_liked = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
$stmt_is_liked = $connect->prepare($query_is_liked);
$stmt_is_liked->execute([$post['post_id'], $user_id]);
$is_liked = $stmt_is_liked->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post with Comments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>

        .post-card {
            display: flex;
            flex-direction: column;
            height: 80%;
        }

        .post-content {
            flex-grow: 1;  
            margin-bottom: 10px;  
            height: 100%;
        }

        .comments-container {
            max-height: 400px; 
            overflow-y: auto; 
            padding-right: 10px;
            width: 100%;

            background-color: #2c2f33; 
            border-radius: 10px; 
            margin-bottom: 20px; 
        }

        .post-image {
            margin-bottom: 20px; 
            overflow: hidden;
            width: 100%; 
            max-height: 400px; 
        }

                
        .col-lg-4 {
            width: 400px; 
            max-height: 100%; 
            overflow: hidden; 
        }

        .comment-box {
            background-color: #3b4045;  
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .comment-box:hover {
            background-color: #4c535a; /* Darker shade on hover */
        }

    </style>
</head>
<body class="bg-dark text-light d-flex justify-content-center align-items-center vh-100">
    <div class="container bg-secondary text-light rounded-3 p-4 shadow post-card">
        <div class="row g-4">
            <div class="position-absolute top-0 end-0 m-3">
                <button class="btn btn-link text-light" onclick="window.location.href='hobby_explorer.php';">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="col-lg-8 col-12 post-content">
        
                <div class="post-image">
                    <img src="uploads/<?= htmlspecialchars($post['post_pic']) ?>" alt="Post Picture" class="img-fluid">
                </div>
        
                <p class="text-muted">
                    <?php echo $post['content']; ?>
                </p>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                    <img src="uploads/<?= $post['profile_pic'] ?>" alt="Profile Picture" class="rounded-circle me-2" width="40" height="40">
                    <strong><?php echo $post['username']; ?></strong>
                    </div>
                    <i class="fa-solid fa-ellipsis"></i>
                </div>
                <hr class="text-light">
                <div class="d-flex align-items-center justify-content-between">
                    <form method="POST" action="./backend_add_like.php?post_id=<?= $post['post_id'] ?>" class="d-flex gap-2">
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            <?php if ($is_liked): ?>
                                <i class="fa-solid fa-heart"></i> Liked
                            <?php else: ?>
                                <i class="fa-regular fa-heart"></i> Like?
                            <?php endif; ?>
                        </button>
                    </form>
                    <p class="mb-0"><?= $like_count ?> likes</p> 
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="mb-3">
                    <div class="comments-container p-3">
                        <?php 
                        $query = "SELECT * FROM comments WHERE comments.post_id = {$post['post_id']} ORDER BY created_at DESC";
                        $stmt = $connect->prepare($query);
                        $stmt->execute();
                        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php if (count($comments) > 0): ?>
                            <?php foreach($comments as $comment): ?>
                                <div class="comment-box">
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="images/dog.jpg" alt="Commenter Picture" class="rounded-circle me-2" width="40" height="40">
                                        <strong><?= htmlspecialchars($comment['username'] ?? 'Anonymous') ?></strong>
                                    </div>
                                    <p class="mb-1"><?= htmlspecialchars($comment['content'] ?? '') ?></p>
                                    <div class="d-flex justify-content-between text-muted small">
                                        <span><?= $comment['created_at'] ?></span>
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No comments yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <form method="POST" action="./backend_add_comment.php?post_id=<?= $post['post_id'] ?>" class="d-flex gap-2">
                    <input type="text" name="content" class="form-control" placeholder="Add a comment..." required>
                    <button name="add_comment" type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>