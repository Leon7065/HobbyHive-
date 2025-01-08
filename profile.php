<?php
  require("./backend_fetch_user_posts.php");
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <div class="d-flex">
    <?php include('./header.php'); ?>
        <main class="main-content">
            <div class="bg-light">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        
                        <div class="col-12 mb-4 text-center">
                            <div class="card shadow-sm profile-card">
                                <div class="row g-0">
                                    <div class="col-md-4 p-3 text-center">
                                        <img src="https://randomuser.me/api/portraits/men/64.jpg" class="rounded-circle img-thumbnail" alt="Profile Picture">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body profile-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="card-title">John Doe</h5>
                                                <button onclick="window.location.href='./edit_profile.php';" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </div>
                                            <p class="card-text">
                                                bio here
                                            </p>
                                            <div class="profile-stats">
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Posts</h5>
                                                        <p class="card-text">25</p>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Following</h5>
                                                        <p class="card-text">142</p>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">Followers</h5>
                                                        <p class="card-text">289</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer profile-footer">
                                    <div class="d-flex justify-content-around">

                                        <div class="profile-hobbies">
                                            <h5>Hobbies</h5>
                                            <div class="hobby-grid">
                                                <div class="hobby-card">
                                                    <i class="fas fa-plane"></i>
                                                    <div>Travel</div>
                                                </div>
                                                <div class="hobby-card">
                                                    <i class="fas fa-book"></i>
                                                    <div>Read</div>
                                                </div>
                                                <div class="hobby-card">
                                                    <i class="fas fa-code"></i>
                                                    <div>Code</div>
                                                </div>
                                                <div class="hobby-card">
                                                    <i class="fas fa-camera"></i>
                                                    <div>Photos</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-12">
                          <div class="row">
                          
                              <?php
                              if (isset($posts) && count($posts) > 0) {
                                  foreach ($posts as $post) {
                                      echo '
                                      <div class="col-md-4 mb-4">
                                          <div class="card post-card">
                                          
                                              <img src="./uploads/' . htmlspecialchars($post['post_pic']) . '" class="card-img-top" alt="Post Image">
                                              <div class="card-body">
                                              
                                                  <p class="card-text">' . htmlspecialchars($post['content']) . '</p>
                                                
                                                  <div class="card-hover">
                                                      <i class="fas fa-thumbs-up"></i>
                                                      <i class="fas fa-comment"></i>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>';
                                  }
                              } else {
                                  echo '<p>No posts available.</p>';
                              }
                              ?>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>