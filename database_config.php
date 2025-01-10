<?php
  $server = 'localhost';
  $dbname = 'hobbyhive';
  $username = 'root';
  $password = '';

  try {
      $connect = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
      echo "Something went wrong: " . $e->getMessage();
  }
?>
