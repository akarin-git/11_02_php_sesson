<?php

include('functions.php');

$id = $_GET['id'];
// var_dump($id);
// exit();
$pdo = connect_to_db();
$sql = 'DELETE FROM post_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit();
if($status == false){
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header('location:content.php');
}





?>