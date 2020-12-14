<?php
session_start();
include('../functions.php');
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

$search = 'アウトドア';
$search_item = "%" . $search . "%";
// var_dump($search);
// exit();

$sql = 'SELECT * FROM post_table WHERE category LIKE :category';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':category', $search_item, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $row_count = $stmt->rowCount();
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $rows[] = $row;
    // var_dump($row);
    // exit();
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../content.css">
</head>

<style>
  .search_count {
    border: 1px solid rgb(149, 146, 146);
    width: 40%;
    padding: 25px;
    background: #fff;
  }

  .search_count h1 {
    font-size: 18px;
  }
</style>

<body>

  <a href="../main.php">戻る</a>

  <div class="search_count">
    <h1>検索結果</h1>
    <p>該当 <?php echo $row_count ?> 件</p>
  </div>

  <section class="container">
    <div class="output_box">
      <?php foreach ($rows as $row) : ?>
        <div class="output">
          <img src="../images/<?php echo "{$row['image']}"; ?>" alt="">
          <h1><?php echo $row['title'] ?></h1>
          <div class="output_text">
            <p><?php echo $row['text'] ?></p>
            <p><?php echo $row['category'] ?></p>
          </div>
          <div class="output_date">
            <span>
              <p><?php echo $row['created_at'] ?></p>

            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


</body>

</html>