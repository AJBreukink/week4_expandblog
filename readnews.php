<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="sidenav">
      <h3> Categories: <h3>
      <a href="categories.php?category=1">Programming</a>
      <a href="categories.php?category=2">In the News</a>
      <a href="categories.php?category=3">Daily Life</a>
      <a href="categories.php?category=4">Interesting</a>
    </div>

  <div class="container">

    <div class="welcome">
      <h1>AJ Blog</h1>
      <a href="index.php">Back to home page</a>
      </div>

    <div class="news-box">

        <div class="news">
            <?php
                // get requested article by its id
                $dbh = connect_to_db();
                $id_article;
                if(isset($_GET['id'])){
                $id_article = (int)$_GET['id'];
              }
                $other_articles;
                if ( !empty($id_article) && $id_article > 0) {
                    // Fetch news
                    $article = getAnArticle( $id_article, $dbh );
                    $article = $article[0];
                    $other_articles = getOtherArticles( $id_article, $dbh );

                }else{
                    $article = false;
                    echo "<strong>Verkeerd Artikel!</strong>";
                }


                ?>

            <?php if (!empty($article) && $article) :

                  $newsCategories = fetchNewsCategories($article->id, $dbh);
                      foreach ($newsCategories as $key => $cat) {
                  ?>
                  <div id="category"><?= $cat->name ?></div>
                <?php } ?>

            <h2><?= stripslashes($article->title) ?></h2>
            <div><?= stripslashes($article->content) ?></div>
            <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
            <?php else:?>

            <?php endif?>
        </div>

        <hr>
        <br>
        <br>
        <br>
        <br>
        <h3>Other articles</h3>
        <div class="similar-posts">
        <?php if ( !empty($other_articles) && $other_articles ) :
                $i = 0;
                foreach ($other_articles as $key => $article) :

                      $newsCategories = fetchNewsCategories($article->id, $dbh);
                          foreach ($newsCategories as $key => $cat) {
                      ?>
                      <div id="category"><?= $cat->name ?></div>
                      <?php } ?>

                <h2><a href="readnews.php?id=<?= $article->id ?>"><?= stripslashes($article->title) ?></a></h2>
                <p><?= stripslashes($article->description) ?></p>
                <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
                <div id="betweenline"> </div>
          <?php
                  if (++$i == 4) break;
                endforeach?>

        <?php endif?>
        </div>

      </div>

    </div>
</body>
</html>
