<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ's Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="sidenav">
      <h3> Categories: <h3>
      <a href="categories.php?category=1">Programming</a>
      <a href="categories.php?category=2">In the News</a>
      <a href="categories.php?category=3">Daily Life</a>
      <a href="categories.php?category=4">Interesting</a>
      <a href="categories.php?category=5">History</a>
      <a href="categories.php?category=6">Technology</a>
    </div>

    <?php
      //fetch articles with selected category_id
      $dbh = connect_to_db();
      $catid;
      if(isset($_GET['category'])){
      $catid = (int)$_GET['category'];
      $news = getCategories($catid, $dbh);
        }
      //replace with name of category
      $category;
      if ($catid == 1) {
      $category = 'Programming';
    } elseif ($catid == 2) {
      $category = 'In the News';
    } elseif ($catid == 3) {
      $category = 'Daily Life';
    } elseif ($catid == 4){
      $category = 'Interesting';
    } elseif ($catid == 5) {
      $category ='History';
    } else {
      $category ='Technology';
    }

      ?>

  <div class="container">

    <div class="welcome">
      <h1>Category: <? echo $category ?></h1>
      <a href="index.php">Back to home page</a>
    </div>

    <div class="news-box">

      <div class="news">

        <?php foreach ($news as $key => $article) {

            $newsCategories = fetchNewsCategories($article->id, $dbh);

              foreach ($newsCategories as $key => $cat) { ?>

          <div id="category"><?= $cat->name ?></div>

          <?php } ?>

          <h2><a href="readnews.php?postid=<?= $article->id ?>"><?= stripslashes($article->title) ?></a></h2>
          <p><?= stripslashes($article->description) ?></p>
          <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
          <div id="betweenline"> </div>
        <?php }?>

        </div>

    </div>

  </div>

</body>
</html>
