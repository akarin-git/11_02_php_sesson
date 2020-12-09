<?php

$msg ="";

include('functions.php');
// var_dump($_FILES['icon_image']['name']);
// exit();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$icon = $_FILES['icon_image']['name']; 
$target ="images/".basename($_FILES['icon_image']['name']);
$pdo = connect_to_db();


// exit('ok');

$sql = 'INSERT INTO user(id, name,email,password,pic,created_at) VALUES(NULL,:name,:email,:password,:pic,sysdate())';

if(move_uploaded_file($_FILES['icon_image']['tmp_name'],$target)) {
  $msg = "Image uploaded successfully";
} else {
  $msg = "There was a problem";
}

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',$name,PDO::PARAM_STR);
$stmt->bindValue(':email',$email,PDO::PARAM_STR);
$stmt->bindValue(':password',$password,PDO::PARAM_STR);
$stmt->bindValue(':pic',$icon,PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();

if($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  header("Location:user.php");
  exit();
}




?>

