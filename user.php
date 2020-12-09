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
      font-family: 'Courier New', Courier, monospace;
      font-size: 16px;
    }

    .user_create {
      width: 80%;
      margin: 0 auto;
      margin-top: 30px;

    }

    .info {
      width: 100%;
      height: 300px;
      background: darkcyan;

    }

    .form {
      width: 100%;
      height: 300px;
      background: darkgrey;

    }
  </style>
</head>

<body>

  <section class="user_create">
    <div class="info">
    </div>

    <div class="form">
      <fieldset>
        <form action="user_create.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000">
          <p>
            名前:<input type="text" name="name">
          </p>
          <p class="error">ニックネームを入力してください</p>

          <p>
            e-mail:<input type="text" name="email">
          </p>
          <p>
            password:<input type="text" name="password">
          </p>
          <p>
            アイコン画像:<input type="file" name="icon_image">
          </p>
          <p>
            <input type="submit" value="登録">
          </p>
        </form>
        <div>
          <p><a href="login.php">ログイン</a></p>
        </div>
      </fieldset>
    </div>
  </section>

</body>

</html>