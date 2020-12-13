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

  
  // var_dump($member);
  // exit();
  $member = $stmt->fetch(PDO::FETCH_ASSOC);

  if($member){
    $_SESSION['id'] = session_id();
    $_SESSION['time'] = time();
    header('location:../main.php');
    exit();
  } else {
    echo('error');
  header('location:user/login.php');
  }
  
?>