<?php


$icon = date('YmdHis') . $_FILES['icon_image']['name'];
// echo($icon);
$target = "images/" . basename($icon);

if (move_uploaded_file($_FILES['icon_image']['tmp_name'], $target)) {
  $msg = "Image uploaded successfully";
} else {
  $msg = "There was a problem";
}

$_SESSION['join'] = $_POST;
$_SESSION['join']['icon'] = $icon;
// var_dump($_SESSION);
// exit();

if (!isset($_SESSION['join'])) {
  // header('location:user.php');
  exit();
}

$name = htmlspecialchars($_SESSION['join']['name'],ENT_QUOTES);
$email = htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES);
$password = htmlspecialchars($_SESSION['join']['password'],ENT_QUOTES);
$icon_image = htmlspecialchars('images/' . $_SESSION['join']['icon'],ENT_QUOTES);
// var_dump($icon_image);
// exit();
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP</title>
  
</head>

<body>
  <div class="">
    <form action="user_join.php">
      <p class="check">name</p>
      <p class="check"><span><?= $name ?></span></p>
      <p class="check">e-mail</p>
      <p class="check"><span><?= $email ?></span></p>
      <p class="check">password</p>
      
      <img src="<?php $icon_image ?>" alt="" height="200px">
      <p><input type="submit" value="登録" class="check"></p>
    </form>
  </div>
</body>

</html>