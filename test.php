<?php
session_start();
include('functions.php');
// var_dump($_POST);
// exit();
$pdo = connect_to_db();

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();
  $members = $pdo->prepare('SELECT * FROM user WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  header('location:user/login.php');
  exit();
}

      $msg = "";

      if (
        !isset($_POST['name']) || $_POST['name'] == "" ||
        !isset($_POST['text']) || $_POST['text'] == "" ||
        !isset($_FILES['image']) || $_FILES['image'] == ""

      ) {
        // exit('入力してください   ');

      }
      if (isset($_POST['upload'])) {
        $image = $_FILES['image']['name'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        

        $target = "images/" . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
          $msg = "Image uploaded successfully";
        } else {
          $msg = "There was a problem ";
        }

        $sql= 'INSERT INTO post_table(user_id,title ,text,image,created_at) VALUES(:user_id,:title,:text,:image,sysdate())';

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':user_id', $member['id'], PDO::PARAM_INT);
  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':text', $text, PDO::PARAM_STR);
  $stmt->bindValue(':image', $image, PDO::PARAM_STR);
  $status = $stmt->execute();
      }


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="content.css">
</head>

<body>

  <p><a href="main.php">戻る</a></p>

  


    <div class="input_form">
      <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">

        <div class="input">
          <ul>
            <li>
              title: <input type="text" name="title">
            </li>
            <li>
              text: <textarea type="text" rows="5" cols="35" name="text" placeholder="説明を書いてください"></textarea>
            </li>
            <li>
              <input type="file" name="image">
            </li>
            <li>
              <input type="submit" name="upload" value="送信">
            </li>
          </ul>
        </div>
      </form>
    </div>

  </section>

</body>

</html>