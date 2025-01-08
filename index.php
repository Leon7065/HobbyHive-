<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
	include_once('config.php');
	if(empty($_SESSION['email']))
	{
		header('Location: login.php');
	}
?>

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
                                <?php 
                                $posts = [
                                    ['name' => 'Clyde Stanley', 'date' => 'March 16', 'content' => 'Best vacation of 2023', 'image' => 'https://bootdey.com/img/Content/avatar/avatar6.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar1.png'],
                                    ['name' => 'Jessica Hart', 'date' => 'April 2', 'content' => 'Exploring the mountains!', 'image' => 'https://bootdey.com/img/Content/avatar/avatar5.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar2.png'],
                                    ['name' => 'Alice Miller', 'date' => 'May 5', 'content' => 'My summer road trip', 'image' => 'https://bootdey.com/img/Content/avatar/avatar7.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar3.png'],
                                    ['name' => 'Sam Taylor', 'date' => 'June 10', 'content' => 'A relaxing beach day', 'image' => 'https://bootdey.com/img/Content/avatar/avatar4.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar4.png'],
                                    ['name' => 'Nina Roberts', 'date' => 'July 7', 'content' => 'Trekking in the wild', 'image' => 'https://bootdey.com/img/Content/avatar/avatar3.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar1.png'],
                                    ['name' => 'Liam Green', 'date' => 'August 15', 'content' => 'Amazing city adventures!', 'image' => 'https://bootdey.com/img/Content/avatar/avatar2.png', 'post_image' => 'https://bootdey.com/img/Content/avatar/avatar5.png']
                                ];
                                foreach ($posts as $post) { ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-3">
                                                    <a href="#"><img src="<?= $post['image'] ?>" alt="" width="50" class="rounded-circle" /></a>
                                                    <div class="flex-fill ps-2">
                                                        <div class="fw-bold"><a href="#" class="text-decoration-none"><?= $post['name'] ?></a></div>
                                                        <div class="small text-body text-opacity-50"><?= $post['date'] ?></div>
                                                    </div>
                                                </div>
                                                <p class="text-center"><?= $post['content'] ?></p>
                                                <div class="profile-img-list text-center">
                                                    <div class="profile-img-list-item main">
                                                        <a href="#" data-lity="" class="profile-img-list-link">
                                                            <span class="profile-img-content" 
                                                                  style="background-image: url('<?= $post['post_image'] ?>');
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
