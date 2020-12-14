<?php
session_start();
include('../functions.php');

  if (!isset($_SESSION['join'])) {
    header('location:user.php');
   exit();
  }

  if(!empty($_POST)){
  $name = $_SESSION['join']['name'];
  $email = $_SESSION['join']['email'];
  $password = sha1($_SESSION['join']['password']);

  $pdo = connect_to_db();
  $sql = 'INSERT INTO user(id,name,email,password,created_at) VALUES(NULL,:name,:email,:password,sysdate())';

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
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <section>
    <div>
      <h1>確認画面</h1>

      <div>
        <p></p>
        <form action="" method="post">
          <input type="hidden" name="action" value="submit">

          <dl>
            <dt>name</dt>
            <dd>
              <?php echo (htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?>
            </dd>
            <dt>e-mail</dt>
            <dd>
              <?php echo (htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?>
            </dd>
            <dt>password</dt>
            <dd>
              * 表示されません
            </dd>
          </dl>
            <p><a href="user.php?action=rewrite">書き直す</a></p>
            <p><input type="submit" value="登録"></p>

      </div>

      <div>
      </div>
      </form>
    </div>
  </section>

</body>

</html>

