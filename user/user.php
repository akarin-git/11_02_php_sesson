<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include('../functions.php');

if(!empty($_POST)){
  if ($_POST['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($_POST['email'] === '') {
    $error['email'] = 'blank';
  }
  if (strlen($_POST['password']) < 4) {
    $error['password'] = 'length';
  }
  if ($_POST['password'] === '') {
    $error['password'] = 'blank';
  }

  // 登録済みか確認
  if(empty($error)){
    $email = $_POST['email'];
    $pdo = connect_to_db();
    $sql = 'SELECT COUNT(*) AS cnt FROM user WHERE email=:email';
    $member = $pdo->prepare($sql);
    $member->bindValue(':email', $email, PDO::PARAM_INT);
    $status = $member->execute();
    // var_dump($status);
    // exit();
    $result = $member->fetch();
    if (!$result){
      $error['email'] = 'duplicate';
    }
  }

  if(empty($error)){
    $_SESSION['join'] = $_POST;
    header('location:user_join_check.php');
    exit();
  }

  if($_REQUEST['action'] == 'rewrite' && isset($_SESSION['join'])){
    $_POST = $_SESSION['join'];
  }
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    body {
      background: rgb(54, 112, 199);
    }

    .user_form {
      height: 300px;
      width: 400px;
      background: #fff;
      margin: 0 auto;
      margin-top: 70px;
      padding: 70px;
    }

    .user_form h1 {
      margin: 0;
    }

    .submit {
      margin-top: 50px;
    }

    .error {
      color: red;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <section class="user_create">
    <div class="user_form">
      <div class="form">

        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000">
          <p>name:</p>
          <input type="text" name="name" value="<?php echo (htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
          <?php if ($error['name'] === 'blank') : ?>
            <p class="error">* 名前を入力してください</p>
          <?php endif; ?>
          <p>e-mail:</p><input type="text" name="email" value="<?php echo (htmlspecialchars($_POST['email'], ENT_QUOTES)); ?>">
          <?php if ($error['email'] === 'blank') : ?>
            <p class="error">* メールアドレスを入力してください</p>
          <?php endif; ?>
          <?php if ($error['email'] === 'duplicate') : ?>
            <p class="error">* 登録済みです</p>
          <?php endif; ?>

          <p>password:</p><input type="password" name="password" value="<?php echo (htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
          <?php if ($error['password'] === 'blank') : ?>
            <p class="error">* パスワードを入力してください</p>
          <?php endif; ?>
          <?php if ($error['password'] === 'length') : ?>
            <p class="error">* 4文字以上で入力してください</p>
          <?php endif; ?>

          <div class="submit">
            <p>
              <input type="submit" value="登録">
            </p>
        </form>
        <div>
          <p><a href="login.php">ログイン</a></p>

        </div>
      </div>

    </div>
    </div>


  </section>

</body>

</html>