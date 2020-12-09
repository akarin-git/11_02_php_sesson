<?php

// var_dump($_POST['email']);
// exit();
include('functions.php');

if (
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == '' 

  ) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $pdo = connect_to_db();
  $sql = 'SELECT * FROM post_table WHERE(email,password) VALUES(:email,:password)';

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $status = $stmt->execute();