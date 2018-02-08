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

    <div class="welcome">
      <h1> Welcome to AJ's Blog</h1>
        <a href="addpost.php">Write an Article</a>
    </div>

    <div class="news-box">

      <div class="news">
        <?php
          // get the database handler
          $dbh = connect_to_db();
          // Fetch news
          $news = fetchNews($dbh);


          //put in one by one descending
          if ( $news && !empty($news) ) :

          foreach ($news as $key => $article) {
            //attach categories
            $newsCategories = fetchNewsCategories($article->id, $dbh);
                foreach ($newsCategories as $key => $cat) {
          ?>
          <div id="category"><?= $cat->name ?></div>
        <?php } ?>
          <h2><?= stripslashes($article->title) ?></a></h2>
          <p><?= stripslashes($article->description) ?></p>
          <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
          <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
          <div id="betweenline"> </div>
        <?php }?>
      <?php endif?>

        </div>

    </div>

  </div>

</body>
</html>
