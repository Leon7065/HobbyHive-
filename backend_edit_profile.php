<?php
session_start();
require('./database_config.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);
try {
    $user_id = $_SESSION['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio']; 
    $hobbies = $_POST['hobbies']; 
    $profile_pic = null;
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profilePic']['tmp_name'];
        $fileName = $_FILES['profilePic']['name'];
        $fileSize = $_FILES['profilePic']['size'];
        $fileType = $_FILES['profilePic']['type'];
        
        $uploadFileDir = './uploads/';
        $dest_path = $uploadFileDir . $fileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $profile_pic = $dest_path; 
        } else {
            echo "Error moving the uploaded file.";
        }
    }
    $sql = "UPDATE users SET 
                fullname = :fullname,
                email = :email,
                phonenumber = :phonenumber,
                gender = :gender" . 
                ($profile_pic ? ", profile_pic = :profile_pic" : "") . 
            " WHERE user_id = :user_id";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phonenumber', $phonenumber);
    $stmt->bindParam(':gender', $gender);
    if ($profile_pic) {
        $stmt->bindParam(':profile_pic', $profile_pic);
    }
    $stmt->bindParam(':user_id', $user_id);
    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>