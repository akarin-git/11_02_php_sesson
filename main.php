<?php

session_start();
include('functions.php');

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


$sql = 'SELECT * FROM post_table ORDER BY id DESC LIMIT 3';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// var_dump($status);
// exit();

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="main.css">
</head>

<body>
  <!-- header -->
  <header>
    <section class="header_container">

      <div class="header_content">
        <div class="header_title">
          <h1>PHP</h1>
          <p>hello <?php echo (htmlspecialchars($member['name'])) ?></p>
        </div>
        <div class="content_menu">
          <ul>
            <li>
              <a href="content.php">みんなのDIY</a>
            </li>
            <!-- <li>
              <a href="">コンテンツ</a>
            </li>
            <li>
              <a href="">コンテンツ</a>
            </li> -->
          </ul>

        </div>
      </div>

      <!-- <div class="header_search">
      <form action="search.php" method="post">
        <input type="text" name="items">
    
        <input type="submit" value="送信">
      </form>
    </div> -->



      <div class="user_content">

        <div class="user_form">
          <div class="user_form_btn">
            <a href="user/user.php"><button>新規登録</button></a>
            <a href="user/login.php"><button>ログイン</button></a>
            <a href="user/logout.php"><button>ログアウト</button></a>
          </div>
        </div>
      </div>
    </section>

  </header>

  <main>

    <section class="top_conteiner">
      <div class="main_top_title">
        <h1>LET TRY search</h1>
        <p>DIY project</p>
        <div class="header_search">
          <form action="search/search.php" method="post">
            <input type="text" name="search">

            <input type="submit" value="送信">
          </form>
        </div>
      </div>

      <div class="top_images_box">

        <?php foreach ($result as $record) : ?>
          <a href="content.php">
            <div class="top_image">
              <img src="images/<?php echo "{$record['image']}"; ?>" alt="">
              <h1><?php echo $record['title'] ?></h1>
              <p><?php echo $record['text'] ?></p>
            </div>
          </a>
        <?php endforeach; ?>

      </div>
    </section>

    <section class="main_conteiner">

      <div class="content_search">
        <div class="search_category">
          <h1 class="search_title">search</h1>
          <ul>
            <li><a href="search/search_easy.php">すぐ作れる</a></li>
            <li><a href="search/search_digital.php">デジタル</a></li>
            <li><a href="search/search_living.php">家具</a></li>
            <li><a href="search/search_craft.php">クラフト</a></li>
            <li><a href="search/search_lifeline.php">日用品</a></li>
            <li><a href="search/search_outdoor.php">アウトドア</a></li>
          </ul>
        </div>


      </div>

      <!-- php 記事埋め込み -->
      <div class="content_post">
        <div class="post">
          <ul>
            <li>a</li>
            <li>a</li>
            <li>a</li>
          </ul>

        </div>
      </div>
      <!-- ここまで -->
    </section>

    <section class="sub_conteiner">
      <div class="content_sub">

      </div>
    </section>



  </main>
  <footer>

  </footer>


</body>

</html>