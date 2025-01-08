<?php include('./backend_fetch_user.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hobby Hive!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .badge-container .badge {
            margin-right: 5px;
        }
    </style>
    <link rel="stylesheet" href="./css/sidebar.css">
    <link rel="stylesheet" href="./css/post.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/add_post.css">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column flex-shrink-0 position-fixed">
        <button class="toggle-btn" onclick="toggleSidebar()">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="p-4"></div>
        <div class="nav flex-column">
            <a href="./index.php" class="sidebar-link text-decoration-none p-3">
                <i class="fas fa-home me-3"></i>
                <span class="hide-on-collapse">Home</span>
            </a>
            <a href="./hobby_explorer.php" class="sidebar-link text-decoration-none p-3">
                <i class="fa-solid fa-magnifying-glass me-3"></i>
                <span class="hide-on-collapse">H-Explorer</span>
            </a>
            <a href="./add_post.php" class="sidebar-link text-decoration-none p-3">
                <i class="fa-regular fa-square-plus me-3"></i>
                <span class="hide-on-collapse">New Post</span>
            </a>
            <?php if ($user['role'] === 1): ?>
                <a href="#" class="sidebar-link text-decoration-none p-3">
                    <i class="fas fa-cog me-3"></i>
                    <span class="hide-on-collapse">Admin Panel</span>
                </a>
            <?php endif; ?>
            <br>    
            <a href="./backend_logout.php" class="sidebar-link text-decoration-none p-3">
                <i class="fa-solid fa-arrow-right-from-bracket me-3"></i>
                <span class="hide-on-collapse">Log Out</span>
            </a>
        </div>
        <div class="profile-section mt-auto p-4">
        <a href="./profile.php" class="sidebar-link text-decoration-none">
                <div class="d-flex align-items-center">
                    <?php 
                        $profilePic = !empty($user['profile_pic']) ? htmlspecialchars($user['profile_pic']) : './images/profile.jpg';
                    ?>
                    <img src="<?php echo $profilePic; ?>" style="height:60px" class="rounded-circle" alt="Profile">
                    <div class="ms-3 profile-info">
                        <h6 class="text-white mb-0"><?php echo htmlspecialchars($user['fullname']); ?></h6>
                        <span class="text-white">Profile</span>
                    </div>
                </div>
            </a>
</div>
    </nav>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</div>
</body>
</html>