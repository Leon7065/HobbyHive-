<?php
    require('./database_config.php');
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if(isset($_POST['register'])){
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $phonenumber = $_POST['phonenumber'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    if ($password !== $confirm_password) {
      echo "Passwords do not match!";
      exit(); 
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $role = 0;

    $emailQuery = "SELECT COUNT(*) AS email_count FROM users WHERE email = :email";
    $emailStmt = $connect->prepare($emailQuery);
    $emailStmt->bindParam(':email', $email);
    $emailStmt->execute();
    $emailResult = $emailStmt->fetch(PDO::FETCH_ASSOC);

    if ($emailResult['email_count'] > 0) {
      echo "User already registered with this email!";
      exit();
    }

    $usernameQuery = "SELECT COUNT(*) AS username_count FROM users WHERE username = :username";
    $usernameStmt = $connect->prepare($usernameQuery);
    $usernameStmt->bindParam(':username', $username);
    $usernameStmt->execute();
    $usernameResult = $usernameStmt->fetch(PDO::FETCH_ASSOC);

    if ($usernameResult['username_count'] > 0) {
      echo "Username is already taken!";
      exit();
    }


    $sql = "INSERT INTO users(fullname, username, email, password, gender, phonenumber, role) values (:fullname, :username, :email, :password, :gender, :phonenumber, :role)";
    $connect->exec("USE hobbyhive");

    $sqlQuery = $connect->prepare($sql);

    $sqlQuery->bindParam(':fullname', $fullname);
    $sqlQuery->bindParam(':username', $username);
    $sqlQuery->bindParam(':email', $email);
    $sqlQuery->bindParam(':password', $password_hash);
    $sqlQuery->bindParam(':gender', $gender);
    $sqlQuery->bindParam(':phonenumber', $phonenumber);
    $sqlQuery->bindParam(':role', $role);

    if ($sqlQuery->execute()) {
        header("Location: ../login.php");
        exit();
    } else {
        echo "Registration failed!";
        header("Location: ../signup.php");
        exit();
    }
  }
?>