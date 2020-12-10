
<?php
session_start();
include('functions.php');
// echo($icon);

$_SESSION['join'] = $_POST;

$name = $_SESSION['join']['name'];
$email = $_SESSION['join']['email'];
$password = sha1($_SESSION['join']['password']);

$pdo = connect_to_db();
$sql = 'INSERT INTO user(id, name,email,password,created_at) VALUES(NULL,:name,:email,:password,sysdate())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();



if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  unset($_SESSION['join']);
  header('location:clear.php');
  exit();
}
?>