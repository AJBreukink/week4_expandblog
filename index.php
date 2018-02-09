<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ's Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
</head>
<body>

    <div class="sidenav">
      <h3> Categories: <h3>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div1');"><span>Programming</span></button>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div2');"><span>In the News</span></button>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div3');"><span>Daily Life</span></button>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div4');"><span>Interesting</span></button>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div5');"><span>History</span></button>
        <button class="button" style="vertical-align:middle"
        onclick="divVisibility('Div6');"><span>Technology</span></button>
    </div>

    <div class="welcome">
      <h1> Welcome to AJ's Blog</h1>
        <a href="addpost.php">Write an Article</a>
    </div>

    <div class="news-box">

      <div class="selectcategories">

      <div id='Div1'>
        <h3>Category selected: Programming</h3>
        <?php
          //fetch articles with selected category id
          $dbh = connect_to_db();
          $news = getCategories(1, $dbh);
          foreach ($news as $key => $article) {

              $newsCategories = fetchNewsCategories($article->id, $dbh);

                foreach ($newsCategories as $key => $cat) { ?>

            <div id="category"><?= $cat->name ?></div>

            <?php } ?>

            <h2><?= stripslashes($article->title) ?></h2>
            <p><?= stripslashes($article->description) ?></p>
            <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
            <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
            <div id="betweenline"> </div>
          <?php }?>
      </div>

      <div id='Div2'>
        <h3>Category selected: In the News</h3>
        <?php
          //fetch articles with selected category id
          $dbh = connect_to_db();
          $news = getCategories(2, $dbh);
          foreach ($news as $key => $article) {

              $newsCategories = fetchNewsCategories($article->id, $dbh);

                foreach ($newsCategories as $key => $cat) { ?>

            <div id="category"><?= $cat->name ?></div>

            <?php } ?>

            <h2><?= stripslashes($article->title) ?></h2>
            <p><?= stripslashes($article->description) ?></p>
            <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
            <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
            <div id="betweenline"> </div>
          <?php }?>
        </div>

          <div id='Div3'>
            <h3>Category selected: Daily Life</h3>
            <?php
              //fetch articles with selected category id
              $dbh = connect_to_db();
              $news = getCategories(3, $dbh);
              foreach ($news as $key => $article) {

                  $newsCategories = fetchNewsCategories($article->id, $dbh);

                    foreach ($newsCategories as $key => $cat) { ?>

                <div id="category"><?= $cat->name ?></div>

                <?php } ?>

                <h2><?= stripslashes($article->title) ?></h2>
                <p><?= stripslashes($article->description) ?></p>
                <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
                <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
                <div id="betweenline"> </div>
              <?php }?>
          </div>

          <div id='Div4'>
            <h3>Category selected: Interesting</h3>
            <?php
              //fetch articles with selected category id
              $dbh = connect_to_db();
              $news = getCategories(4, $dbh);
              foreach ($news as $key => $article) {

                  $newsCategories = fetchNewsCategories($article->id, $dbh);

                    foreach ($newsCategories as $key => $cat) { ?>

                <div id="category"><?= $cat->name ?></div>

                <?php } ?>

                <h2><?= stripslashes($article->title) ?></h2>
                <p><?= stripslashes($article->description) ?></p>
                <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
                <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
                <div id="betweenline"> </div>
              <?php }?>
            </div>

              <div id='Div5'>
                <h3>Category selected: History</h3>
                <?php
                  //fetch articles with selected category id
                  $dbh = connect_to_db();
                  $news = getCategories(5, $dbh);
                  foreach ($news as $key => $article) {

                      $newsCategories = fetchNewsCategories($article->id, $dbh);

                        foreach ($newsCategories as $key => $cat) { ?>

                    <div id="category"><?= $cat->name ?></div>

                    <?php } ?>

                    <h2><?= stripslashes($article->title) ?></h2>
                    <p><?= stripslashes($article->description) ?></p>
                    <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
                    <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
                    <div id="betweenline"> </div>
                  <?php }?>
              </div>

              <div id='Div6'>
                <h3>Category selected: Technology</h3>
                <?php
                  //fetch articles with selected category id
                  $dbh = connect_to_db();
                  $news = getCategories(6, $dbh);
                  foreach ($news as $key => $article) {

                      $newsCategories = fetchNewsCategories($article->id, $dbh);

                        foreach ($newsCategories as $key => $cat) { ?>

                    <div id="category"><?= $cat->name ?></div>

                    <?php } ?>

                    <h2><?= stripslashes($article->title) ?></h2>
                    <p><?= stripslashes($article->description) ?></p>
                    <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
                    <p id="postdate" >Posted on <?= date('jS M Y H:i:s', strtotime($article->postdate)) ?> </p>
                    <div id="betweenline"> </div>
                  <?php }?>
              </div>

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
