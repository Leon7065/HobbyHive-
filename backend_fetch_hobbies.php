<?php 
  require('./database/config.php'); 
  ini_set('display_errors', 1);
  error_reporting(E_ALL);
  try {
    $sql = "SELECT * FROM hobbies";
    $selectHobbies = $connect->prepare($sql);
    $selectHobbies->execute();
    $hobbies = $selectHobbies->fetchAll();

  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>