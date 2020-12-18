<?php


session_start();
include('functions.php');
$pdo = connect_to_db();
// var_dump($_GET);
// exit();
$id = $_GET['id'];


if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  $_SESSION['time'] = time();
  $members = $pdo->prepare('SELECT * FROM user WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
  // var_dump($member);
  // exit();
} else {
  header('location:user/login.php');
  exit();
}

$sql = 'SELECT * FROM post_table WHERE id=:id';
// $sql = 'SELECT * FROM post_table  LEFT OUTER JOIN (SELECT post_id,COUNT(id) AS cnt FROM likes_table GROUP BY post_id) AS likes ON post_table.id = likes.post_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($status);
// exit();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump($result);
// exit();


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .view_box {
      width: 80%;
      background: #a0a0a0;
      margin: 0 auto;
      margin-top: 80px;
      display: flex;
      padding: 40px;
    }

    .view_img {
      width: 50%;
    }

    .view_img img {
      width: 100%;
    }

    .view_text {
      margin: 0 auto;
      display: block;
      width: 50%;
    }

    .name_box {
      text-align: right;
    }

    .text_box {
      text-align: center;
      height: 50%;
    }

    .text_sub {
      font-size: 12px;
      text-align: right;
    }
  </style>
</head>

<body>
  <section class="view_box">
    <div class="view_img">
      <img src="images/<?php echo "{$result['image']}"; ?>" alt="">
    </div>
    <div class="view_text">
      <div class="name_box">
        <p>name : <?php echo $member['name'] ?></p>
      </div>
      <div class="text_box">
        <h1><?php echo $result['title'] ?></h1>
        <p><a href="likes.create.php?post_id=<?php echo $record['id'] ?>&user_id=<?php echo $member['id'] ?>">like</a><a href=""></a></i></p>
        <p><?php echo $result['text'] ?></p>
      </div>
      <div class="text_sub">
        <p><?php echo $result['created_at'] ?></p>
        <p></p>
      </div>
    </div>

  </section>

</body>

</html>