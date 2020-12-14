<?php
session_start();
include('../functions.php');

if (
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' 
  
  ) {
    echo '<p>エラー </p>';
    exit();
  }
  
  $email = $_POST['email'];
  $password = sha1($_POST['password']);
  // var_dump($password);
  // exit();

  $pdo = connect_to_db();
  // exit('pdo');
  $sql = 'SELECT * FROM user WHERE email=:email and password=:password';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password,PDO::PARAM_STR);
  $status = $stmt->execute();

  
  $member = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if(!$member){
    echo '<p>登録情報に偽りがあります </p>';
    
    exit();
  } else {
    $_SESSION['id'] = $member['id'];
    $_SESSION['time'] = time();
    // var_dump($_SESSION['id']);
    // exit();
    header('location:../main.php');
    exit();
  }
  
?>