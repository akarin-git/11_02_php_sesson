<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>

    body {
      margin: 0;
      padding: 0;
      background: rgb(54, 112, 199);
    }
    .login_form {
      height: 300px;
      width: 400px;
      background: #fff;
      margin: 0 auto;
      margin-top: 70px;
      padding: 70px;
    }
    .login_form h1{
      margin: 0;
    }

  </style>
</head>

<body>
  <div class="login_form">
    <h1>login</h1>
    <form action="login_create.php" method="post">
      <p>

        email:<input type="text" name="email">
      </p>
      <p>
        password:<input type="password" name="password">
      </p>
      <p>
        <input type="submit" name="submit" value="送信">
      </p>
      <p><a href="user.php">登録はこちら</a></p>
    </form>
  </div>

</body>

</html>