<?php
require('./database/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Fill all the fields!";
        header("Location: ./login.php");
        exit();
    }
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $data = $stmt->fetch();
        if (password_verify($password, $data['password'])) {
            $_SESSION['email'] = $data['email'];
            $_SESSION['user_id'] = $data['user_id'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Password incorrect";
            header("Location: ./login.php");
            exit();
        }
    } else {
        session_destroy();
        $_SESSION['error'] = "User not found!!";
        header("Location: ./login.php");
        exit();
    }
}
?>