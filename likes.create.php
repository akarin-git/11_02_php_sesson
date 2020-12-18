<?php

session_start();
include('functions.php');

// var_dump($_GET);
// exit();
$post_id =$_GET['post_id'];
$user_id =$_GET['user_id'];

$pdo = connect_to_db();

// $sql = 'INSERT INTO likes_table(id,user_id,post_id,created_at) VALUES (NULL,:user_id,:post_id,sysdate())';
$sql = 'SELECT COUNT(*) FROM likes_table WHERE user_id=:user_id AND post_id=:post_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $like_count = $stmt->fetch();
  
  if($like_count[0] != 0){
    $sql = 'DELETE FROM likes_table WHERE user_id=:user_id AND post_id=:post_id';
  } else {
    $sql = 'INSERT INTO likes_table(id,user_id,post_id,created_at) VALUES (NULL,:user_id,:post_id,sysdate())';
  }
  
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
  $status = $stmt->execute();
  // var_dump($like_count[0]);
  // exit();

  if($status == false){
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    header("location:content.php");
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
</body>
</html>
