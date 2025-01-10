<?php
require('./database_config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['hobbies'])) {
    $description = $_POST['description'];
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageSize = $_FILES['image']['size'];
        $imageError = $_FILES['image']['error'];

        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExtension, $allowedExtensions)) {
            if ($imageSize < 5000000) { 
                $imageNewName = uniqid('', true) . '.' . $imageExtension;
                $imageDestination = './uploads/' . $imageNewName;

                if (move_uploaded_file($imageTmpName, $imageDestination)) {
                } else {
                    echo "Error uploading image!";
                    exit();
                }
            } else {
                echo "Image file size is too large!";
                exit();
            }
        } else {
            echo "Invalid image file type!";
            exit();
        }
    } else {
        echo "No image uploaded!";
        exit();
    }

    try {
        $connect->exec("USE hobbyhive");

        $sql = "INSERT INTO posts (user_id, post_pic, content, created_at) VALUES (:user_id, :image, :content, NOW())";
        $sqlQuery = $connect->prepare($sql);

        session_start();
        $userId = $_SESSION['user_id'];

        $sqlQuery->bindParam(':user_id', $userId);
        $sqlQuery->bindParam(':image', $imageNewName); 
        $sqlQuery->bindParam(':content', $description);

        if ($sqlQuery->execute()) {
            $postId = $connect->lastInsertId();

            if (!empty($hobbies)) {
                $hobbySql = "INSERT INTO post_hobbies (post_id, hobby_id) VALUES (:post_id, :hobby_id)";
                $hobbyStmt = $connect->prepare($hobbySql);

                foreach ($hobbies as $hobbyId) {
                    $hobbyStmt->bindParam(':post_id', $postId);
                    $hobbyStmt->bindParam(':hobby_id', $hobbyId);
                    $hobbyStmt->execute();
                }
            }

            echo "Post added successfully!";
            header("Location: ./index.php");
            exit();
        } else {
            echo "Failed to add post!";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    echo "No hobbies selected!";
    exit();
}
?>
