<?php
include("functions.php");
$title = $_POST['title'];
$text = $_POST['text'];
$id = $_POST['id'];

$pdo = connect_to_db();

$sql = "UPDATE post_table SET title=:title, text=:text,updated_at=sysdate() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':text',$text,PDO::PARAM_STR);
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit();

if($status == false){
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("location:content.php");
  exit();
}
?>