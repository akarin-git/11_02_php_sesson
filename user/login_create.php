<?php
session_start();
include('../functions.php');

if (
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' 
  
  ) {
    // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
    echo json_encode(["error_msg" => "no input"]);
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

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  // var_dump($member);
  // exit();

  if($member){
    $_SESSION['id'] = $member['id'];
    $_SESSION['time'] = time();
    header('location:../main.php');
    exit();
  } else {
    echo('error');
  header('location:user/login.php');
  }
  
?>