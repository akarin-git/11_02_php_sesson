<?php


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
  </style>
</head>

<body>

  <section class="user_create">
    <div class="user_form">
      <div class="form">

        <form action="user_join.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000">
          <p>name:</p>
          <input type="text" name="name" required>

          <p>e-mail:</p><input type="text" name="email" required>

          <p>password:</p><input type="password" name="password" required>

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