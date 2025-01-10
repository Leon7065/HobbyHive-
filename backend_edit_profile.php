<?php
session_start();
require('./database_config.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    if (!isset($_SESSION['user_id'])) {
        echo "User is not logged in.";
        exit;
    }

    $user_id = $_SESSION['user_id'];

    if (isset($_POST['edit'])) {
        $fullname = htmlspecialchars(trim($_POST['fullname']));
        $phonenumber = htmlspecialchars(trim($_POST['phonenumber']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $bio = htmlspecialchars(trim($_POST['bio']));
        $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
        $profile_pic = null;

        if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['profilePic']['tmp_name'];
            $fileName = basename($_FILES['profilePic']['name']);
            $fileSize = $_FILES['profilePic']['size'];
            $fileType = $_FILES['profilePic']['type'];

            $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxFileSize = 2 * 1024 * 1024; // 2MB

            if (!in_array($fileType, $allowedFileTypes)) {
                echo "Invalid file type. Only JPG, PNG, and GIF are allowed.";
                exit;
            }

            if ($fileSize > $maxFileSize) {
                echo "File size exceeds 2MB limit.";
                exit;
            }

            $uploadFileDir = './uploads/';
            $dest_path = $uploadFileDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profile_pic = $fileName;
            } else {
                echo "Error moving the uploaded file.";
                exit;
            }
        }

        $sql = "UPDATE users SET 
                    fullname = :fullname,
                    phonenumber = :phonenumber,
                    gender = :gender,
                    bio = :bio" . 
                    ($profile_pic ? ", profile_pic = :profile_pic" : "") . 
                " WHERE user_id = :user_id";

        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':phonenumber', $phonenumber);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':bio', $bio);
        if ($profile_pic) {
            $stmt->bindParam(':profile_pic', $profile_pic);
        }
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            $sqlDeleteHobbies = "DELETE FROM user_hobbies WHERE user_id = :user_id";
            $stmtDelete = $connect->prepare($sqlDeleteHobbies);
            $stmtDelete->bindParam(':user_id', $user_id);
            $stmtDelete->execute();

            $sqlInsertHobbies = "INSERT INTO user_hobbies (user_id, hobby_id) VALUES (:user_id, :hobby_id)";
            $stmtInsert = $connect->prepare($sqlInsertHobbies);

            foreach ($hobbies as $hobby_id) {
                $stmtInsert->bindParam(':user_id', $user_id);
                $stmtInsert->bindParam(':hobby_id', $hobby_id);
                $stmtInsert->execute();
            }

            echo "Profile updated successfully.";
            header("Location: ./profile.php?user_id=" . $user_id);
        } else {
            echo "Error updating profile.";
            header("Location: ./edit_profile.php");
        }
    } else {
        echo "Invalid form submission.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
