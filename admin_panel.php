<?php
require('./database_config.php');
require('./header.php');  

$query = "SELECT * FROM users";
$stmt = $connect->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $delete_query = "DELETE FROM users WHERE user_id = ?";
    $stmt_delete = $connect->prepare($delete_query);
    $stmt_delete->execute([$delete_user_id]);

    header("Location: admin_panel.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .user-actions i {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Admin Panel - User Management</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Registered Users</h4>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Profile Picture</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['user_id']) ?></td>
                                <td><img src="uploads/<?= htmlspecialchars($user['profile_pic']) ?>" alt="Profile Pic" width="50" class="rounded-circle"></td>
                                <td><?= htmlspecialchars($user['fullname']) ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['role']) ?></td>
                                <td class="user-actions">
                                    <a href="admin_panel.php?delete_user_id=<?= $user['user_id'] ?>" class="text-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
