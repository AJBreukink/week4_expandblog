<?php require 'functions.php'; ?>
<html>
<head>
  <meta charset="utf-8">
  <title>AJ Blog</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="script.js"></script>
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

  <div class="container">

    <div class="welcome">
      <h1>AJ Blog</h1>
      <a href="index.php">Back to home page</a>
      </div>

    <div class="news-box">

        <div class="news">
            <?php
                // get id of requested article
                $dbh = connect_to_db();
                $id_article;
                if(isset($_GET['id'])){
                $id_article = (int)$_GET['id'];
                  }
                $other_articles;
                if ( !empty($id_article) && $id_article > 0) {
                    // get the article by id
                    $article = getAnArticle( $id_article, $dbh );
                    $article = $article[0];
                    $commentsYesNo = $article->enablecomments;
                    //echo '<p class="error">comments='.$commentsYesNo.'</p>';
                    $other_articles = getOtherArticles( $id_article, $dbh );

                }else{
                    $article = false;
                    echo "<strong>Verkeerd Artikel!</strong>";
                }

                  if (!empty($article) && $article) :
                  //retrieve the categories attached to the article
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

        <div class='comments'>
          <?php
          if (!empty($article) && $article) {
            //comments allowed yes/no (1=yes)
            if ($commentsYesNo == 1) {
              $newsComments = fetchComments($article->id, $dbh);

              if (!empty($newsComments) && $newsComments) {
                  echo '<h4>Reader Comments</h4>';
                }
                  foreach ($newsComments as $key => $comment) {
                ?>
                <p> <em>A blog visitor said: </em><?= $comment->comment ?></p>
                <button onclick="deleteComment(<?= $comment->id ?>)"
                  style="cursor: pointer;" text-align="center">X</button>
                <div id="betweenCommentsline"> </div>

              <?php } ?>
              <form action='' method='post'>

              <p><label>Share your thoughts on this article:</label><br>

              <textarea name='postComment' cols='70' rows='2'><?php if(isset($error)){ echo $_POST['postComment'];}?></textarea></p>

              <p><input type='submit' name='submit' value='Post'></p>

              </form>
            <?php } else{echo '<h4><em>Comments Disabled</em></h4>';} }?>

        </div>
        <br>

        <?php
        if(isset($_POST['submit'])){
          $postComment = $_POST['postComment'];

          if($postComment ==''){
              $error[] = 'Please enter your comment.';
            }
            if(!isset($error)){

                try {

                  //insert into database
                  $pdo = connect_to_db();
                  $sendComment = "INSERT INTO comments (comment) " .
                                "VALUES ('$postComment')";
                  $pdo->exec($sendComment);
                  $lastID = $pdo->lastInsertId();

                  $commentToArticle =
                  "INSERT INTO blogarticles_comments (article_id, comment_id)" .
                              "VALUES ('$id_article', '$lastID')";
                  $pdo->exec($commentToArticle);

                  header('Location: readnews.php?id='.$id_article);
                  exit;

            } catch(PDOException $e) {
                echo '<p class="error">'.$e->getMessage().'</p>';
            }
          }
        }
        if(isset($error)){
            foreach($error as $error){
                echo '<p class="error">'.$error.'</p>';
            }
        }
          ?>

        <br><br><br><br><br><br><br><br><br><br><br><br>
        <hr>
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

                <h2><?= stripslashes($article->title) ?></h2>
                <p><?= stripslashes($article->description) ?></p>
                <p><a href="readnews.php?id=<?= $article->id ?>"><em>Read more...</em></a></p>
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
