<?php

include('functions.php');
// var_dump($_POST);
// exit();

$msg = "";

if (
  !isset($_POST['name']) || $_POST['name'] == "" ||
  !isset($_POST['text']) || $_POST['text'] == "" ||
  !isset($_FILES['image']) || $_FILES['image'] == ""

) {
  // exit('入力してください   ');

}
if(isset($_POST['upload'])){
  $image = $_FILES['image']['name'];
  $title = $_POST['title'];
  $text = $_POST['text'];

$target = "images/" . basename($_FILES['image']['name']);

$pdo = connect_to_db();

$sql = 'INSERT INTO post_table(id,title,text,image,created_at) VALUES (NULL,:title,:text,:image,sysdate())';

if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
  $msg = "Image uploaded successfully";
} else {
  $msg = "There was a problem ";
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->bindValue(':image', $image, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();
if($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  header('location:content.php');
}
exit();
}