<?php
session_start();
	include_once('config.php');
	if(empty($_SESSION['email']))
	{
		header('Location: login.php');
	}
?>
<?php include('./backend_fetch_posts.php'); ?>
<div class="d-flex">
    <?php include('./header.php'); ?>
    <main class="main-content">
        <div class="bg-light">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="container mt-4">
                        <h1 class="text-center mb-4 hobby-hive-title">
                            <div class="hexagon-container">
                                <div class="logo"></div>
                                <span class="hobby-title">Hobby Hive</span>
                            </div>
                        </h1>
                        <div class="profile">
                            <div class="row g-4">
                                <?php foreach ($posts as $post) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card mb-3 shadow-sm">
                                            <a href="./preview_post.php?post_id=<? $post['post_id'] ?>" class="text-decoration-none text-dark">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <a href="#"><img src="uploads/<?= $post['user_profile_pic'] ?>" alt="" width="50" class="rounded-circle" /></a>
                                                        <div class="flex-fill ps-2">
                                                            <div class="fw-bold"><a href="#" class="text-decoration-none"><?= $post['user_name'] ?></a></div>
                                                            <div class="small text-body text-opacity-50"><?= $post['created_at'] ?></div>
                                                        </div>
                                                    </div>
                                                    <p class="text-center"><?= $post['content'] ?></p>
                                                    <div class="profile-img-list text-center">
                                                        <div class="profile-img-list-item main">
                                                            <a href="./preview_post.php?post_id=<?= $post['post_id'] ?>" data-lity="" class="profile-img-list-link">
                                                                <span class="profile-img-content" 
                                                                      style="background-image: url('uploads/<?= $post['post_pic'] ?>');
                                                                            display: block; 
                                                                            width: 100%; 
                                                                            height: 200px; 
                                                                            background-size: cover; 
                                                                            background-position: center;">
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <hr class="mb-1 opacity-1" />
                                                    <div class="row text-center fw-bold">
                                                        <div class="col-6">
                                                            <a href="#" class="text-body text-opacity-50 text-decoration-none d-block p-2 like-btn">
                                                                <i class="far fa-heart me-1"></i> Like
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="text-body text-opacity-50 text-decoration-none d-block p-2">
                                                                <i class="far fa-comment me-1"></i> Comment
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once("footer.php"); ?>
    <script>
    function toggleLike(event) {
        const likeBtn = event.target.closest('.like-btn');
        likeBtn.classList.toggle('liked');
    }
    </script>
</div>