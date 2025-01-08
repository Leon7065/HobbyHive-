<!DOCTYPE html>
<?php require('./backend_fetch_post_id.php')  ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post with Comments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .content-wrapper {
            background-color: #202124;
            color: #f1f1f1;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            background-color: #2a2b2d;
            border-radius: 12px;
            padding: 20px;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .post-section {
            flex: 1;
            margin-right: 20px;
        }
        .post-image img {
            width: 100%;
            border-radius: 8px;
        }
        .post-description {
            margin-top: 10px;
            font-size: 0.95rem;
            color: #ccc;
        }
        .comments-section {
            flex: 0.4;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .comments-section .comment {
            background-color: #1e1e1e;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .comments-section .interaction-bar {
            font-size: 0.85rem;
            color: #aaa;
        }
        .add-comment {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .add-comment input {
            flex-grow: 1;
            border: 1px solid #444;
            border-radius: 20px;
            background-color: #444;
            color: #fff;
            padding: 10px;
        }
        .add-comment button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
        }
        .add-comment button:hover {
            background-color: #0056b3;
        }
        .post-header, .comment-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .post-header img, .comment-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        hr {
            border-color: #444;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="post-section">
            <div class="post-image">
            <img src='uploads/<?= htmlspecialchars($post['post_pic']) ?>'
                  style='width: 100px; height: auto;' alt='Post Picture'/>
            </div>
            <p class="post-description">
                <?php echo $post['content'] ?>            
            </p>
            <div class="post-header">
                <div class="d-flex align-items-center">
                <img src="uploads/<?= $post['profile_pic'] ?>">
                <strong class="ms-2"><?php echo $post['username'] ?></strong>
                </div>
                <i class="fa-solid fa-ellipsis"></i>
            </div>
            <hr>
            <div class="interaction-bar">
                <button class="like-button">
                    <i class="fa-regular fa-heart"></i> Like?
                </button>
                <p>37 likes</p>
            </div>
        </div>
        <div class="comments-section">
            <div class="comment">
                <div class="comment-header">
                    <div class="d-flex align-items-center">
                        <img src="images/dog.jpg" alt="Commenter Picture">
                        <strong class="ms-2">Username</strong>
                    </div>
                </div>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque laborum culpa autem adipisci quasi accusamus nam inventore consectetur illo praesentium! Earum provident nulla harum voluptatum voluptas cupiditate asperiores dicta culpa.
                </p>
                <div class="interaction-bar">
                    <span>timestamp</span>
                    <span>15 likes</span>
                    <i class="fa-regular fa-heart"></i>
                </div>
            </div>
            <form class="add-comment">
                <input type="text" placeholder="Add a comment..." required>
                <button type="submit">Post</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>