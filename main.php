


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
  <section class="header_conteiner">

  <div class="header_content">
    <div class="header_title">
      <h1>PHP</h1>
    </div>
    <div class="content_menu">
      <ul>
        <li>
          <a href="content.php">コンテンツ</a>
        </li>
        <li>
          <a href="">コンテンツ</a>
        </li>
        <li>
          <a href="">コンテンツ</a>
        </li>
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
      <div class="user_icon">i</div>
      <div class="user_form_btn">
        <a href="user.php"><button>新規登録</button></a>
        <a href="login.php"><button>ログイン</button></a>
      </div>
    </div>
</div>
</section>

</header>
<div class="mordal">
<!-- モーダル -->
</div>

<main>

  <section class="top_conteiner">
    <div class="main_top_title">
      <h1>タイトル</h1>
      <p>DIY project</p>
    </div>

    <div class="top_images_box">

      <div class="top_image">
        <img src="" alt="">
        <h2>タイトル</h2>
        <p>テキスト</p>
      </div>

      <div class="top_image">
        <img src="" alt="">
        <h2>タイトル</h2>
        <p>テキスト</p>
      </div>

      <div class="top_image">
        <img src="" alt="">
        <h2>タイトル</h2>
        <p>テキスト</p>
      </div>
    </div>
  </section>

<section class="main_conteiner">

<div class="content_search">

<div class="search_box">
  <div class="search_input">
    <h1 class="search_title">search</h1>
    <!-- search.php -->
      <form action="search.php" method="post">
      <input type="text" name="items">
      <input type="text">
      <input type="text">
      <input type="submit" value="送信">
      </form>
      <!-- ここまで -->
  </div>

  <div class="search_category">
    <h1 class="category_title">category</h1>
    <ul>
      <li><a href="">木材</a></li>
      <li><a href="">プラスチック</a></li>
      <li><a href="">紙</a></li>
      <li><a href="">デジタル×ものづくり</a></li>
    </ul>
  </div>
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